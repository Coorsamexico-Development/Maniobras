<?php

namespace App\Exports;

use App\Models\ListaAsitencia;
use App\Models\TurnoFecha;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use DateInterval;
use DatePeriod;
use DateTime;
use function PHPSTORM_META\map;

class EmpleadosRhExport implements FromCollection, WithColumnWidths, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $maniobra_id)
    {
        $this->maniobra_id = $maniobra_id;
    }

    public function collection()
    {
         $query = ListaAsitencia::select(
            DB::raw('CONCAT(maniobristas.name,"_",maniobristas.ap_paterno,"_",maniobristas.ap_materno) AS NOMBRE'),
            'turno_fechas.fecha AS FECHA',
            'lista_asitencias.asistencia AS ASISTENCIA'
             )
            ->join('maniobristas', 'lista_asitencias.maniobrista_id', 'maniobristas.id')
            ->join('turno_fechas', 'lista_asitencias.turno_fecha_id', 'turno_fechas.id')
            ->join('turnos', 'turno_fechas.turno_id', 'turnos.id')
            ->join('maniobras', 'turnos.maniobra_id', 'maniobras.id')
            ->where('maniobras.id', '=', $this->maniobra_id)
            ->orderBy('NOMBRE')
            ->orderBy('FECHA')
            ->get();

            $Maniobristas = [];
            $NombreTemporal = "hola";
            
            for ($i=0; $i < count($query) ; $i++)  //agrupacion por maniobristas
            { 
                $fecha = $query[$i]; // se crea el array vacio por maniobrista
                $nombre = $query[$i]->NOMBRE;
    
                $ObjManiobrista = (object)[]; //se crea el objeto vacio por maniobrista
    
                $ObjFechaAsistencia = (object)[];  //se crea el objeto vacio por maniobrista
                $fechas = []; //se crea el array vacio por maniobrista
    
                if($query[$i] === $query[0])
                {
                    $ObjManiobrista->Nombre = $query[$i]->NOMBRE; //objeto global por maniobrista
    
                    $ObjFechaAsistencia->Fecha = $query[$i]->FECHA;
                    $ObjFechaAsistencia->Asistencia = $query[$i]->ASISTENCIA;
                    array_push($fechas, $ObjFechaAsistencia);
                    $ObjManiobrista->fechas = $fechas;
    
                    array_push($Maniobristas, $ObjManiobrista);
                    $NombreTemporal =  $query[$i]->NOMBRE;
                }
                else
                {
                  if($NombreTemporal == $query[$i]->NOMBRE)
                  {
                    // echo count($Maniobristas);
                     for ($x=0; $x < count($Maniobristas) ; $x++) 
                     { 
                        $Maniobrista = $Maniobristas[$x];
                        if($Maniobrista->Nombre === $query[$i]->NOMBRE )
                        {
                           //echo "Son iguales";
                           $ObjFechaAsistencia->Fecha = $query[$i]->FECHA;
                           $ObjFechaAsistencia->Asistencia = $query[$i]->ASISTENCIA;
                           array_push($Maniobrista->fechas, $ObjFechaAsistencia);
                        }
                   
                     }
                  }
                  else //crea los que no existen y almacena el nuevo nombre temporal
                  {
                    $ObjManiobrista->Nombre = $query[$i]->NOMBRE; //objeto global por maniobrista
    
                    $ObjFechaAsistencia->Fecha = $query[$i]->FECHA;
                    $ObjFechaAsistencia->Asistencia = $query[$i]->ASISTENCIA;
                    array_push($fechas, $ObjFechaAsistencia);
                    $ObjManiobrista->fechas = $fechas;
    
                    array_push($Maniobristas, $ObjManiobrista);
                    $NombreTemporal =  $query[$i]->NOMBRE;
                  }
                }
            }
    
       // RECORRIDO PARA EXCEL

       $primer_Fecha = TurnoFecha::select( //consultamos todas las fechas ordenadas
        'turno_fechas.fecha'
        )
        ->join('turnos','turno_fechas.turno_id','turnos.id')
        ->join('maniobras', 'turnos.maniobra_id','maniobras.id')
        ->groupBy('turno_fechas.fecha')
        ->orderBy('turno_fechas.fecha')
        ->where('maniobras.id','=',$this->maniobra_id)
        ->get()
        ->first();

        $ultima_Fecha = TurnoFecha::select( //consultamos todas las fechas ordenadas
          'turno_fechas.fecha'
          )
          ->join('turnos','turno_fechas.turno_id','turnos.id')
          ->join('maniobras', 'turnos.maniobra_id','maniobras.id')
          ->groupBy('turno_fechas.fecha')
          ->orderBy('turno_fechas.fecha','desc')
          ->where('maniobras.id','=',$this->maniobra_id)
          ->get()
          ->first();


      $begin = new DateTime($primer_Fecha->fecha);
      $end = new DateTime($ultima_Fecha->fecha);
      $end->modify('+1 day');
      
      $interval = new DateInterval('P1D');
      $daterange = new DatePeriod($begin, $interval, $end);
      $fechas = [];
      foreach ($daterange as $date) 
      {
        $newDate = $date->format('Y-m-d');
        array_push($fechas, $newDate);
      }

      //var_dump($fechas);
     /* var_dump('-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',
      $Maniobristas);*/

       $Reporte = [];
       for ($c=0; $c < count($Maniobristas); $c++) //recorremos los maniobristas
       { 
          $DatosManiobrista = [];
          $NombreManiobrista = $Maniobristas[$c]->Nombre;
          array_push($DatosManiobrista, $NombreManiobrista);
          $indice = 0;
          for ($t=0; $t < count($Maniobristas[$c]->fechas) ; $t++) //recorremos las fechas que tiene el maniobrista asignadas
           { 
             $fechaActual = $Maniobristas[$c]->fechas[$t];  //guardamos la fecha a recorrer
             //var_dump($fechaActual);
             //var_dump($fechaActual->Asistencia);
             //var_dump($fechaActual->Fecha);
          
             for ($indice; $indice < count($fechas) ; $indice++) //recorremos el rango de fechas
             { 
              
              //var_dump($fechas[$y]);
              //var_dump('-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',$indice);
              $fechaActualFechas = $fechas[$indice];
              if($fechaActual->Fecha == $fechaActualFechas)
              {
                //echo true;
                //var_dump("hola");
                
                //var_dump($fechaActual->Asistencia);
                if($fechaActual->Asistencia == 0)
                {
                  array_push($DatosManiobrista, "0");
                  $indice = $indice +1;
                }
                else
                {
                  array_push($DatosManiobrista, "1");
                  $indice = $indice +1;
                }
 
                break;
              

              }
              else
              {
                array_push($DatosManiobrista," ");         
              }
          
             }
           }

          array_push($Reporte,$DatosManiobrista);
       }


       //var_dump("----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", $Reporte);
       return new Collection($Reporte);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,           
        ];
    }

    
    public function headings(): array
    {
        $headings = ["Nombre"];

        $primer_Fecha = TurnoFecha::select( //consultamos todas las fechas ordenadas
          'turno_fechas.fecha'
          )
          ->join('turnos','turno_fechas.turno_id','turnos.id')
          ->join('maniobras', 'turnos.maniobra_id','maniobras.id')
          ->groupBy('turno_fechas.fecha')
          ->orderBy('turno_fechas.fecha')
          ->where('maniobras.id','=',$this->maniobra_id)
          ->get()
          ->first();
  
          $ultima_Fecha = TurnoFecha::select( //consultamos todas las fechas ordenadas
            'turno_fechas.fecha'
            )
            ->join('turnos','turno_fechas.turno_id','turnos.id')
            ->join('maniobras', 'turnos.maniobra_id','maniobras.id')
            ->groupBy('turno_fechas.fecha')
            ->orderBy('turno_fechas.fecha','desc')
            ->where('maniobras.id','=',$this->maniobra_id)
            ->get()
            ->first();


        $begin = new DateTime($primer_Fecha->fecha);
        $end = new DateTime($ultima_Fecha->fecha);
        $end->modify('+1 day');
        
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);

        foreach ($daterange as $date) 
        {
          $newDate = $date->format('Y-m-d') . PHP_EOL;
          array_push($headings, $newDate);
        }

        return $headings;
    }
}
