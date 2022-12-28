<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ButtonAdd from "@/Components/ButtonAdd.vue";
import ModalAddManiobra from "../Maniobras/Partials/ModalAddManiobra.vue";
import ManiobrasList from "../Maniobras/Partials/ManiobrasList.vue";
import Graph2 from "../Maniobras/Partials/Graph2.vue";
import Graph1 from "@/Components/Graph1.vue";

const props = defineProps({
    maniobras: Object,
    clientes: Object,
    status_maniobras: Object,
    maniobristas: Object,
    total_turnos_fecha: Object,

    data_grafico_circulo:Object,
    data_grafico_series:Object
});

/*Recorrido reestructuracion data para grafico series*/ 

let arregloGraphSeries = ref([]);
let fechaTemporal = "";
let turnoTemporal = "";

let ObjetoTemporalFecha = {};
let ObjetoTemporalTurno = {};

for (let indi = 0; indi < props.data_grafico_series.length; indi++) 
{
    const Obj = props.data_grafico_series[indi];
    //console.log(Obj);
    if(Obj == props.data_grafico_series[0])
    {
        ObjetoTemporalTurno[`${Obj.turno}`] = {
             requeridos: Obj.cant_asistencia,
             asistieron: Obj.lista_asistencia,
             salario:Obj.salario
          }
        ObjetoTemporalFecha[`${Obj.fecha}`] = ObjetoTemporalTurno;

        arregloGraphSeries.value.push(ObjetoTemporalFecha);
        fechaTemporal = Obj.fecha;
        turnoTemporal = Obj.turno;
    }
    else
    {
        if(Obj.fecha == fechaTemporal)
        {
          if(Obj.turno == turnoTemporal) 
          {
           //console.log( ObjetoTemporalFecha[`${Obj.fecha}`][`${Obj.turno}`]);
           ObjetoTemporalFecha[`${Obj.fecha}`][`${Obj.turno}`].requeridos += Obj.cant_asistencia;
           ObjetoTemporalFecha[`${Obj.fecha}`][`${Obj.turno}`].asistieron += Obj.lista_asistencia;
           ObjetoTemporalFecha[`${Obj.fecha}`][`${Obj.turno}`].salario += Obj.salario;
          }
          else //si el turno es diferente
          {
           //console.log(ObjetoTemporalFecha[`${Obj.fecha}`] );
            ObjetoTemporalFecha[`${Obj.fecha}`][`${Obj.turno}`] = 
            {
              requeridos: Obj.cant_asistencia,
              asistieron: Obj.lista_asistencia,
              salario:Obj.salario
            };   
          }

          fechaTemporal = Obj.fecha;
          turnoTemporal = Obj.turno;
        }
        else //si la fecha es distinta
        {
           let newObjectFecha = {};
           let newObjectTurno = {};

           newObjectTurno[`${Obj.turno}`] = {
             requeridos: Obj.cant_asistencia,
             asistieron: Obj.lista_asistencia,
             salario:Obj.salario
          }
          newObjectFecha[`${Obj.fecha}`] = newObjectTurno;

          arregloGraphSeries.value.push(newObjectFecha);
          fechaTemporal = Obj.fecha;
          turnoTemporal = Obj.turno;
        }
    }


 
}

//console.log(arregloGraphSeries.value);

//console.log(arregloGraphSeries);

/*Fin recorrido reestructuracion data para grafico series*/ 


/*Recorrido reestructuracion data para grafico circular*/ 
let arregloGraphCircular = ref([]);
let turnoTemp = "";

for (let indice = 0; indice < props.data_grafico_circulo.length; indice++)
 {
    const elemento = props.data_grafico_circulo[indice];
    if(elemento == props.data_grafico_circulo[0])
    {
        arregloGraphCircular.value.push(
            {
                turno:elemento.turno,
                cant_asistencia:elemento.cant_asistencia,
                lista_asistencia:elemento.lista_asistencia,
                salario:elemento.salario
            }
        );
        turnoTemp = elemento.turno;
    }
    else
    {
      if(elemento.turno !== turnoTemp)
      {
        arregloGraphCircular.value.push(
            {
                turno:elemento.turno,
                cant_asistencia:elemento.cant_asistencia,
                lista_asistencia:elemento.lista_asistencia,
                salario:elemento.salario
            }
        );
        turnoTemp = elemento.turno
      }
      else
      {
        
         for (let indice2 = 0; indice2 < arregloGraphCircular.value.length; indice2++)
         {
            const elemento2 = arregloGraphCircular.value[indice2];
            if(elemento2.turno == elemento.turno)
            {
               elemento2.cant_asistencia += elemento.cant_asistencia;
               elemento2.lista_asistencia += elemento.lista_asistencia,
               elemento2.salario += elemento.salario
            }
         }
      }
    }
 }

 //console.log(arregloGraphCircular.value);

/*Fin recorrido reestructuracion data para grafico circular*/ 

/*Recorrido */

let arregloCalendar = ref([]);
let varTemp = "";
for (
    let index = 0;
    index < props.total_turnos_fecha.length;
    index++ //recorrido generañ
) {
    const element = props.total_turnos_fecha[index];

    if (element.fecha == props.total_turnos_fecha[0].fecha) {
        //agregamos el primero al arreglo de objetos
        arregloCalendar.value.push({
            //si es igual crea el primer objeto del arreglo
            fecha: element.fecha,
            lista_asistencia: element.lista_asistencia,
            cant_asistencia: element.cant_asistencia,
        });

        varTemp = element.fecha;
    } else {
        if (varTemp != element.fecha) {
            //si es diferente a la varibale temporal la cambia
            varTemp = element.fecha;
            arregloCalendar.value.push({
                fecha: element.fecha,
                lista_asistencia: element.lista_asistencia,
                cant_asistencia: element.cant_asistencia,
            });
        } else {
            for (
                let index2 = 0;
                index2 < arregloCalendar.value.length;
                index2++
            ) {
                const element2 = arregloCalendar.value[index2];
                if (element2.fecha == element.fecha) {
                    (element2.lista_asistencia += element.lista_asistencia),
                        (element2.cant_asistencia += element.cant_asistencia);
                }
            }
        }
    }
}

/*Modales*/
const openModalNewManiobra = ref(false);

const nuevaManiobra = () => {
    openModalNewManiobra.value = true;
};

const closeModalNewManiobra = () => {
    openModalNewManiobra.value = false;
};


const message = ref(true);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Maniobras
            </h2>
            <ButtonAdd
                class="px-2 py-2 mr-10 -m-8"
                @click="nuevaManiobra"
                style="float: right"
            >
                <svg
                    viewBox="0 0 20 20"
                    enable-background="new 0 0 20 20"
                    class="inline-block w-6 h-6"
                >
                    <path
                        fill="#FFFFFF"
                        d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"
                    />
                </svg>
            </ButtonAdd>
        </template>
        <div>
            <div class="inline-flex mt-10 mr-28" style="float: right">
                <!----<button
                class="px-2 py-2 text-xs font-bold text-gray-800 bg-gray-300 rounded-l opacity-50 cursor-not-allowed hover:bg-gray-400"
            >-->
                <button
                    @click="message = !message"
                    type="button"
                    class="inline-flex items-center px-2 py-2 -mr-16 text-xs text-blue-600 uppercase bg-white rounded-xl font-xs hover:bg-slate-100 border-slate-200"
                >
                    <svg
                        version="1.1"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        height="20px"
                        width="15px"
                        x="5px"
                        y="5px"
                        viewBox="0 0 455 455"
                        style="enable-background: new 0 0 455 455"
                    >
                        <path
                            d="M415,102.509c-22.091,0-40,17.909-40,40c0,5.542,1.128,10.821,3.166,15.62l-83.791,83.792
	c-4.799-2.038-10.078-3.167-15.621-3.167s-10.822,1.129-15.621,3.167l-50.053-50.053c2.038-4.799,3.166-10.078,3.166-15.621
	c0-22.091-17.909-40-40-40c-22.091,0-40,17.909-40,40c0,5.542,1.128,10.821,3.166,15.62l-83.792,83.791
	c-4.799-2.038-10.078-3.167-15.621-3.167c-22.091,0-40,17.909-40,40s17.909,40,40,40s40-17.909,40-40
	c0-5.542-1.128-10.821-3.166-15.62l83.792-83.791c4.799,2.038,10.078,3.166,15.621,3.166c5.542,0,10.821-1.128,15.62-3.166
	l50.054,50.054c-2.038,4.799-3.166,10.078-3.166,15.62c0,22.091,17.909,40,40,40c22.091,0,40-17.909,40-40
	c0-5.542-1.128-10.821-3.166-15.62l83.791-83.792c4.799,2.038,10.078,3.166,15.621,3.166c22.091,0,40-17.909,40-40
	S437.091,102.509,415,102.509z"
                        />
                    </svg>

                    {{ message ? " Grafícas" : " Ocultar" }}
                </button>
            </div>
        </div>

        <div :class="message ? 'grid grid-cols-1 ' : 'lg:grid grid-cols-2'">
            <div class="mt-20">
                <div
                    class="ml-10 mr-10"
                    v-for="maniobra in maniobras"
                    :key="maniobra.id"
                >
                    <ManiobrasList
                        :arregloCalendar="arregloCalendar"
                        :maniobra="maniobra"
                        :maniobristas="maniobristas"
                        :message="message"
                    ></ManiobrasList>
                </div>
            </div>

            <div>
                
                <div 
                :class="
                            message
                                ? 'grid grid-cols-1 gap-20 grafica_scroll_sm mt-24'
                                : 'grid grid-cols-1 gap-20 grafica_scroll mt-24'
                        "
                >
                    <div
                        :class="
                            message
                                ? 'hidden bg-white rounded-3xl shadow-2xl'
                                : 'bg-white rounded-3xl shadow-2xl'
                        "
                    >
                      <Graph2 :data ="arregloGraphSeries"></Graph2>

                    </div>
                    <div
                        :class="
                            message
                                ? 'hidden bg-white rounded-3xl shadow-2xl'
                                : 'bg-white rounded-3xl shadow-2xl'
                        "
                    >
                        <Graph1 :data="arregloGraphCircular"></Graph1>
                    </div>
                </div>
            </div>
        </div>

        <ModalAddManiobra
            :clientes="clientes"
            :status_maniobras="status_maniobras"
            :show="openModalNewManiobra"
            @close="closeModalNewManiobra"
        ></ModalAddManiobra>
    </AppLayout>
    
</template>

<style>
.grafica_scroll {
    overflow-y: scroll;
    overflow-x: scroll;
    width: 100%;
    height: 40%;
}

.grafica_scroll_sm {
    overflow-y: hidden;
    overflow-x: hidden;
}
</style>
