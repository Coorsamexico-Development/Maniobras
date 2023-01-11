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
import ActionMessage from '@/Components/ActionMessage.vue';
import { Fancybox } from "@fancyapps/ui/src/Fancybox/Fancybox.js";
import "@fancyapps/ui/dist/fancybox.css";

var props = defineProps({
    date: {
        type: Date,
        required: true
    },
    turno: Number,
    maniobristas: Object
});



const formManiobristas = useForm({
    fecha: null,
    turno: null,
    file: null
});

/*Subida de archivo*/
let fileUpload = ref(null);
const selectNewFile = () => {
    fileUpload.value.click();
};


const uploadFile = () => {
    let file = fileUpload.value.files[0];
    formManiobristas.file = file;
    console.log(formManiobristas.file);

    let fecha = new Date(props.date);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const año = fecha.getFullYear();

    let fechaCompleta = año + '-' + mes + '-' + dia;
    formManiobristas.turno = props.turno;
    formManiobristas.fecha = fechaCompleta;

    if (fileUpload.value != null) {
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
                <div class="flex flex-col items-center w-full">
                    <div class="my-2">
                        <form>
                            <input type="file" accept=".xlsx , text/xlsx" ref="fileUpload" @change="uploadFile"
                                class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-blue-900 hover:file:bg-blue-100 ">
                        </form>
                        <span v-show="formManiobristas.processing" class="text-sm">
                            Cargando...
                        </span>
                    </div>

                    <ActionMessage :on="formManiobristas.recentlySuccessful" class="mr-3 ">
                        <span class="text-green-500">Guarado.</span>
                    </ActionMessage>
                    <div class="">
                        <a :href="route('export')">
                            <BtnDownload>Descargar ejemplo</BtnDownload>
                        </a>
                    </div>
                </div>

            </slot>

        </template>
        <br><br><br>
        <template #table-header>

            <tr class="text-center text-md ">
                <th scope="col"
                    class="px-8 py-3 ml-12 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-200 border-b-2 border-gray-300">
                    <span>
                        Nombre
                    </span>
                </th>
                <th
                    class="px-5 py-3 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-200 border-b-2 border-gray-300 shadow-2xl">
                    Foto
                </th>
            </tr>
        </template>
        <template #table-body>
            <tr v-for="maniobrista in maniobristas" :key="maniobrista.id">
                <td>
                    {{ maniobrista.name + ' ' + maniobrista.ap_paterno + ' ' + maniobrista.ap_materno }}
                </td>
                <td>
                    <a v-if="maniobrista.imagen_url !== '-'" data-fancybox data-type="image"
                        :href="maniobrista.imagen_url" class="inline-block mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            <path
                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                        </svg>
                    </a>
                </td>
            </tr>
        </template>
    </DataTable>
</template>
