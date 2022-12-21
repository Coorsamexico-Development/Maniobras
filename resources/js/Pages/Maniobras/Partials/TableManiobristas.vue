<script setup>
import { computed, ref } from 'vue';
import DataTable from '../../../Components/DataTable.vue';
import Checkbox from '@/Components/Checkbox.vue';
import axios from 'axios';
import InputLabel from '@/Components/InputLabel.vue';
import { useForm } from "@inertiajs/inertia-vue3";
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';
import BtnDownload from '@/Components/ButtonDownload.vue';

var props = defineProps({
  date:{ type: String,
        required: true},
  turno:Object,
  maniobristas:Object
});



const formManiobristas =useForm({
     fecha:null,
     turno:null,
     file:null
   });

/*Subida de archivo*/ 
let fileUpload = ref(null);
const selectNewFile = () => 
{
    fileUpload.value.click();
};


const uploadFile = () => 
{   let file = fileUpload.value.files[0];
    formManiobristas.file = file;
    console.log(formManiobristas.file);

    let fecha = new Date(props.date);
    const dia = fecha.getDate();
    const mes = fecha.getMonth()+1;
    const año = fecha.getFullYear();

    let fechaCompleta = año+'-'+mes+'-'+dia;
    formManiobristas.turno = props.turno;
    formManiobristas.fecha = fechaCompleta;
  
    if(fileUpload.value != null)
    {
        formManiobristas.post(route("lista.store"), {
         onFinish: () => formManiobristas.reset(),

       });
    }
    
}


</script>
<template>
    <DataTable>
        <template #section-header>
            <slot name="section-header">
                <div class="ml-12 -mt-8 -mb-6 sm:-ml-10 lg:ml-36 lg:-mt-14">
                <form>
                        <input type="file" accept=".xlsx , text/xlsx"  ref="fileUpload"
                         @change="uploadFile" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-blue-900 hover:file:bg-blue-100 ">
                </form>
                </div>
            </slot>
            <div class="ml-12 lg:-ml-64 lg:-mt-10">

            <a :href="route('export')">
                    <br><br>
                    <BtnDownload>Descargar ejemplo</BtnDownload>
                </a>
            </div>
        </template>
        <br><br><br>
        <template #table-header>
            
                <tr class="text-center text-md ">
                    <th scope="col" class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-200 border-b-2 border-gray-300">
                        <span>
                            Nombre 
                        </span>
                    </th>
                    <th class="px-5 py-3 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-200 border-b-2 border-gray-300 shadow-2xl">
                        #
                    </th>
                </tr>
            </template>
            <template #table-body>
                 <tr v-for="maniobrista in maniobristas" :key="maniobrista.id"> 
                    <td>
                        {{maniobrista.name+' '+ maniobrista.ap_paterno+' '+maniobrista.ap_materno}} 
                    </td>
                 </tr>
            </template>
    </DataTable>
</template>
