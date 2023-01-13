<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ButtonAdd from "@/Components/ButtonAdd.vue";
import ModalAddManiobra from "../Maniobras/Partials/ModalAddManiobra.vue";
import ManiobrasList from "../Maniobras/Partials/ManiobrasList.vue";
import Graph1 from "../Maniobras/Partials/Graph1.vue";
import Graph2 from "../Maniobras/Partials/Graph2.vue";
import CalendarModule from '../Maniobras/Partials/CalendarModule.vue';
import ModalCalendar from "./Partials/ModalCalendar.vue";
import ModalTurno from "./Partials/ModalTurno.vue";

const props = defineProps({
    maniobras: Object,
    clientes: Object,
    status_maniobras: Object,
    maniobristas: Object,
    total_turnos_fecha: Object,
    data_grafico_circulo: Object,
    data_grafico_series: Object,
    turnos: Object
});

/*Recorrido reestructuracion data para grafico series*/

//let arregloGraphSeries = ref([]);
const modalCalendar = ref(false);
const modalTurno = ref(false);
const maniobraSelected = ref({ turnos: [] });


const showCalendarManiobra = (maniobra) => {
    maniobraSelected.value = maniobra;
    console.log(maniobraSelected.value.id);
    Inertia.visit(route('maniobras'), {
        data: {
            id_maniobra:maniobraSelected.value.id
        },
        preserveState: true,
        preserveScroll: true,
        only: ['total_turnos_fecha'],
    })
    modalCalendar.value = true;
};

const closeCalendar = () => {
    maniobraSelected.value = { turnos: [] }
    modalCalendar.value = false;
};

const showTurnosManiobra = (maniobra) => {
    maniobraSelected.value = maniobra
    modalTurno.value = true;
};

const closeModalTurn = () => {
    maniobraSelected.value = { turnos: [] }
    modalTurno.value = false;
};

let fechaTemporal = "";
let turnoTemporal = "";

let ObjetoTemporalFecha = {};
let ObjetoTemporalTurno = {};

//console.log(props.data_grafico_series);
// a computed ref
const arregloGraphSeries = computed(() => {
    //console.log(props.data_grafico_series);
    let newArreglo = [];
    for (const fecha in props.data_grafico_series) //recorremos cada objeto
    {
        let newObj = {
            date: fecha
        }

        let totalAsistencia = 0;
        let totalRequeridos = 0;
        let faltas = 0;
        let totalSalario = 0;
        for (let index = 0; index < props.data_grafico_series[fecha].length; index++) {
            let salarioXAsistencias = 0;
            const element = props.data_grafico_series[fecha][index];
            //console.log(element);
            totalRequeridos += element.cant_asistencia;
            totalAsistencia += element.lista_asistencia;
            faltas = totalRequeridos - totalAsistencia;
            salarioXAsistencias = element.lista_asistencia * element.salario;
            totalSalario += salarioXAsistencias;

            let objTurno = {};
            let turno = element.identificador_turno;
            let asistenciaXTurno = element.lista_asistencia;

            newObj[`${element.identificador_turno}`] = asistenciaXTurno;
        }
        newObj.requeridos = totalRequeridos;
        newObj.faltas = faltas
        newObj.pagado = totalSalario;
        newArreglo.push(newObj);
    }

    // console.log(newArreglo);
    return newArreglo;

});
/*Fin recorrido reestructuracion data para grafico series*/

/*Recorrido reestructuracion data para grafico circular*/
const arregloGraphCircular = computed(() => {
    let turnoTemp = "";
    let arregloGraphCircularaux = [];
    for (let indice = 0; indice < props.data_grafico_circulo.length; indice++) {
        const elemento = props.data_grafico_circulo[indice];
        //console.log(elemento);
        if (elemento == props.data_grafico_circulo[0]) {
            arregloGraphCircularaux.push(
                {
                    turno: elemento.turno,
                    cant_asistencia: elemento.cant_asistencia,
                    lista_asistencia: elemento.lista_asistencia,
                    salario: elemento.salario
                }
            );
            turnoTemp = elemento.turno;
        }
        else {
            if (elemento.turno !== turnoTemp) {
                arregloGraphCircularaux.push(
                    {
                        turno: elemento.turno,
                        cant_asistencia: elemento.cant_asistencia,
                        lista_asistencia: elemento.lista_asistencia,
                        salario: elemento.salario
                    }
                );
                turnoTemp = elemento.turno
            }
            else {

                for (let indice2 = 0; indice2 < arregloGraphCircularaux.length; indice2++) {
                    const elemento2 = arregloGraphCircularaux[indice2];
                    if (elemento2.turno == elemento.turno) {
                        elemento2.cant_asistencia += elemento.cant_asistencia;
                        elemento2.lista_asistencia += elemento.lista_asistencia,
                            elemento2.salario += elemento.salario
                    }
                }
            }
        }
    }


//ARREGLO DE CALENDARIO

    //Variables
    //console.log(this.data);
    let datos = arregloGraphCircularaux; //guardamos en una variable data para iterarlos
    let newDatos = [];
    let turnoTemp2 = null;

    for (let index = 0; index < datos.length; index++) {
        const element = datos[index];
        if (element === datos[0]) // si el primero es igual al primero
        {
            let faltas = element.cant_asistencia - element.lista_asistencia;
            newDatos.push(
                {
                    name: element.turno,
                    children: [
                        { name: "Asistencias", value: element.lista_asistencia },
                        { name: "Faltas", value: faltas }
                    ]
                }
            );
            turnoTemp2 = element.turno;
        }
        else //sino, pasamos al sig
        {
            if (element.turno == turnoTemp2) {
                for (let index = 0; index < newDatos.length; index++) {
                    const newElement = newDatos[index];
                    //console.log(newElement);
                    if (element.turno == newElement.name) {
                        let faltas = element.cant_asistencia - element.lista_asistencia;
                        newElement.children[0].value += element.lista_asistencia;
                        newElement.children[1].value += faltas;
                    }
                }
                turnoTemp2 = element.turno;
            }
            else {
                //console.log(false);
                let faltas = element.cant_asistencia - element.lista_asistencia;
                newDatos.push(
                    {
                        name: element.turno,
                        children: [
                            { name: "Asistencias", value: element.lista_asistencia },
                            { name: "Faltas", value: faltas }
                        ]
                    }
                );

            }
        }
    }


    return newDatos;
});
/*Fin recorrido reestructuracion data para grafico circular*/

/*Recorrido  grafico calendario*/
const arregloCalendar = computed(() => {
    let  arregloCalendarAux = [];
    let varTemp = "";
    //recorrido general
    for (let index = 0; index < props.total_turnos_fecha.length; index++)
     {
    const element = props.total_turnos_fecha[index];

    if (element.fecha == props.total_turnos_fecha[0].fecha) {
        //agregamos el primero al arreglo de objetos
         arregloCalendarAux.push({
            //si es igual crea el primer objeto del arreglo
            fecha: element.fecha,
            lista_asistencia: element.lista_asistencia,
            cant_asistencia: element.cant_asistencia,
         });

        varTemp = element.fecha;
    } 
    else
     {
        if (varTemp != element.fecha) 
        {
            //si es diferente a la varibale temporal la cambia
            varTemp = element.fecha;
            arregloCalendarAux.push({
                fecha: element.fecha,
                lista_asistencia: element.lista_asistencia,
                cant_asistencia: element.cant_asistencia,
            });
        } 
        else 
        {
          for (let index2 = 0; index2 < arregloCalendarAux.length; index2++) 
          {
                const element2 = arregloCalendarAux[index2];
                if (element2.fecha == element.fecha) 
                {
                    (element2.lista_asistencia += element.lista_asistencia),
                    (element2.cant_asistencia += element.cant_asistencia);
                }
            }
        }
    }
}

return arregloCalendarAux;
    
});

/*Modales*/
const openModalNewManiobra = ref(false);

const nuevaManiobra = () => {
    openModalNewManiobra.value = true;
};

const closeModalNewManiobra = () => {
    openModalNewManiobra.value = false;
};


const realoadManiobra = (maniobraId) => {
    const maniobraFind = props.maniobras.find((m) => {
        return maniobraId === m.id
    })
    if (maniobraFind !== undefined) {
        maniobraSelected.value = maniobraFind;
    }
}

const message = ref(true);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Maniobras
            </h2>
            <ButtonAdd class="px-2 py-2 mr-10 -m-8" @click="nuevaManiobra" style="float: right">
                <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="inline-block w-6 h-6">
                    <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
                </svg>
            </ButtonAdd>

        </template>
        <div>
            <div style="margin-right: 82px; margin-top: 30px; margin-bottom: -50px; float: right">
                <!----<button
                class="px-2 py-2 text-xs font-bold text-gray-800 bg-gray-300 rounded-l opacity-50 cursor-not-allowed hover:bg-gray-400"
            >-->
                <CalendarModule></CalendarModule>
                <button @click="message = !message" type="button"
                    class="inline-flex items-center px-2 py-2 -mr-16 text-xs text-blue-600 uppercase bg-white rounded-xl font-xs hover:bg-slate-100 border-slate-200">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" height="20px" width="15px" x="5px" y="5px"
                        viewBox="0 0 455 455" style="enable-background: new 0 0 455 455">
                        <path d="M415,102.509c-22.091,0-40,17.909-40,40c0,5.542,1.128,10.821,3.166,15.62l-83.791,83.792
	c-4.799-2.038-10.078-3.167-15.621-3.167s-10.822,1.129-15.621,3.167l-50.053-50.053c2.038-4.799,3.166-10.078,3.166-15.621
	c0-22.091-17.909-40-40-40c-22.091,0-40,17.909-40,40c0,5.542,1.128,10.821,3.166,15.62l-83.792,83.791
	c-4.799-2.038-10.078-3.167-15.621-3.167c-22.091,0-40,17.909-40,40s17.909,40,40,40s40-17.909,40-40
	c0-5.542-1.128-10.821-3.166-15.62l83.792-83.791c4.799,2.038,10.078,3.166,15.621,3.166c5.542,0,10.821-1.128,15.62-3.166
	l50.054,50.054c-2.038,4.799-3.166,10.078-3.166,15.62c0,22.091,17.909,40,40,40c22.091,0,40-17.909,40-40
	c0-5.542-1.128-10.821-3.166-15.62l83.791-83.792c4.799,2.038,10.078,3.166,15.621,3.166c22.091,0,40-17.909,40-40
	S437.091,102.509,415,102.509z" />
                    </svg>

                    {{ message? " Grafícas": " Ocultar" }}
                </button>
            </div>
        </div>

        <div :class="message ? 'grid grid-cols-1 sm:mr-12 ' : 'lg:grid grid-cols-2 sm:mr-12 mr-0'">
            <div class="mt-20">
                <div class="ml-10 mr-10" v-for="maniobra in maniobras" :key="maniobra.id">
                    <ManiobrasList :arregloCalendar="arregloCalendar" :maniobra="maniobra" :message="message"
                        @showTurnos="showTurnosManiobra($event)" @showCalendar="showCalendarManiobra($event)" />
                </div>
            </div>
            <div>

                <div :class="
                    message
                        ? 'grid grid-cols-1 gap-20 grafica_scroll_sm mt-24'
                        : 'grid grid-cols-1 gap-20 grafica_scroll mt-24'
                ">
                    <div :class="
                        message
                            ? 'hidden bg-white rounded-3xl shadow-2xl'
                            : 'bg-white rounded-3xl shadow-2xl'
                    ">
                        <Graph2 :data="arregloGraphSeries" :turnos="turnos"></Graph2>
                        <Graph1 :data="arregloGraphCircular"></Graph1>

                    </div>
                    <div :class="
                        message
                            ? 'hidden bg-white rounded-3xl shadow-2xl'
                            : 'bg-white rounded-3xl shadow-2xl'
                    ">
                        <!----<Graph1 :data="arregloGraphCircular"></Graph1>-->

                    </div>
                </div>
            </div>
        </div>

        <ModalAddManiobra :clientes="clientes" :status_maniobras="status_maniobras" :show="openModalNewManiobra"
            @close="closeModalNewManiobra"></ModalAddManiobra>
        <!--MODALS -->
        <ModalCalendar :show="modalCalendar" :maniobristas="maniobristas" :turnos="maniobraSelected.turnos"
            :arregloCalendar="arregloCalendar" @close="closeCalendar"></ModalCalendar>
        <ModalTurno :show="modalTurno" @close="closeModalTurn" :turnos="maniobraSelected.turnos"
            :maniobra_id="maniobraSelected.id" @realoadManiobra="realoadManiobra($event)" />
    </AppLayout>

</template>

<style>
.grafica_scroll {
    overflow-y: scroll;
    overflow-x: scroll;
    width: 100%;
    height: 80%;
}

.grafica_scroll_sm {
    overflow-y: hidden;
    overflow-x: hidden;
}
</style>
