<script setup>
import { computed, ref } from 'vue';
import DataTable from '@/Components/DataTable.vue';
import Buscador from '@/Components/Buscador.vue';
import SwitchButton from '@/Components/SwitchButton.vue';
import axios from 'axios';
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import { reactive, watch } from 'vue';


var props = defineProps({
  maniobristas:Object,
  filters:Object
});

//Funciones buscador
const params = reactive({
    search: props.filters.search
});


watch(params, (newValue) => {
    Inertia.visit(route("maniobristas"),
        {
            data: {
                search: newValue.search
            },
            replace: true,
            preserveScroll: true,
            preserveState: true,
        });
});

//Funciones switch


const change = (maniobrista_id, check) =>
{
   let newCheck = -1;
   if(check == 1)
   {

      newCheck = !check;
   }
   else
   {
     newCheck = !check;
   }
   
   console.log(newCheck)
   axios.post(route('maniobristas.update', maniobrista_id),
         {
                    maniobristaid: maniobrista_id,
                    checkChange: newCheck,

             }).catch( error =>{
                    if (error.response) {
                        let messageError = '';
                        const messageServer = error.response.data.message
                        if(error.response.status != 500){
                            messageError = messageServer;
                        }else{
                            messageError = 'Internal Server Error';
                        }
                    }
                });
  
 
}
</script>
<template>
    <DataTable>
        <template #section-header>
            <Buscador class="mt-2 " v-model="params.search"></Buscador>    
        </template>
        <template #table-header>
           <tr>
            <th class="px-8 py-3 ml-12  -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Nombre</th>
            <th class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Apellido paterno</th>
            <th class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Apellido materno</th>
            <th class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Telefono</th>
            <th class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Faltas seguidas</th>
            <th class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Faltas totales</th>
            <th class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-300 border-b-2 border-gray-300">Acciones</th>
           </tr>
        </template>
        <template #table-body>
             <tr v-for="maniobrista in maniobristas" :key="maniobrista.id" class="hover:table-fixed hover:bg-gray-200 px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <td class="w-1/12 px-4 py-4 text-sm  ">{{maniobrista.name}}</td>
                <td class="w-1/12 px-4 py-4 text-sm ">{{maniobrista.ap_paterno}}</td>
                <td class="w-1/12 px-4 py-4 text-sm ">{{maniobrista.ap_materno}}</td>
                <td class="w-1/12 px-4 py-4 text-sm ">{{maniobrista.telefono}}</td>
                <td class="w-1/12 px-4 py-4 text-sm ">{{maniobrista.faltas_seguidas}}</td>
                <td class="w-1/12 px-4 py-4 text-sm ">{{maniobrista.faltas_totales}}</td>
                <td>
                    <SwitchButton v-if="maniobrista.active" @change="change(maniobrista.id, maniobrista.active)" checked></SwitchButton>
                    <SwitchButton v-if="!maniobrista.active" @change="change(maniobrista.id, maniobrista.active)" ></SwitchButton>
                </td>
             </tr>    
        </template>
    </DataTable>
</template>
