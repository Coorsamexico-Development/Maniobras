<script setup>
import { computed, ref } from 'vue';
import DataTable from '../../../Components/DataTable.vue';
import Checkbox from '@/Components/Checkbox.vue';
import axios from 'axios';
import InputLabel from '@/Components/InputLabel.vue';
import { useForm } from "@inertiajs/inertia-vue3";
import SecondaryButton from '@/Components/SecondaryButton.vue';

var props = defineProps({
  date:{ type: String,
        required: true},
  turno:Object
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
    formManiobristas.turno = props.turno.id;
    formManiobristas.fecha = fechaCompleta;
  
    if(fileUpload.value != null)
    {
        formManiobristas.post(route("lista.store"), {
         onFinish: () => formManiobristas.reset(),
       });
    }
    
}

const downloadExample = () =>
{
   
}


</script>
<template>
    <DataTable>
        <template #section-header>
            <slot name="section-header">
                <form>
                    <input type="file" accept=".xlsx , text/xlsx"  ref="fileUpload"
                         @change="uploadFile">
                </form>
                <SecondaryButton @click="downloadExample">Descargar ejemplo</SecondaryButton>
            </slot>
        </template>
        <template #table-header>
                <tr class="text-center text-md" >
                    <th scope="col" class="px-2 py-1 text-sm font-semibold tracking-wider uppercase cursor-pointer ">
                        <span>
                            Nombre 
                        </span>
                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </template>
            <template #table-body>

            </template>
    </DataTable>
</template>
