<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import BtnCerrar from '@/Components/BtnCerrar.vue';
import DataTable from '@/Components/DataTable.vue';
import { useForm } from '@inertiajs/inertia-vue3' 
import 'v-calendar/dist/style.css';
import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';

var props = defineProps({
   turnos:Object,
});

const emit = defineEmits(["close",])

const close = () => {
        
        emit('close');
    };


</script>
<template>
     <DialogModal  :show="show" @close="close()" >
           <template #title>
            <h2 class="p-3 pl-6 -mx-6 -mb-8 text-xl font-bold text-blue-900">Turnos</h2>

            </template>
            <template #content >
                <DataTable>
                   <template #section-header>
                       <slot name="section-header">
                        
                       </slot>
                   </template>
                   <template #table-header>
                           <tr class="text-center text-md" >
                               <th scope="col" class="px-5 py-3 -mt-4 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                   <span>
                                       Turno 
                                   </span>
                               </th>
                               <th class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"> 
                                   Hora Inicio
                               </th>
                               <th class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                   Hora Final
                               </th>
                           </tr>
                       </template>
                       <template #table-body>
                          <tr v-for="turno in turnos" :key="turno.id" class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                             <td> {{turno.name}}</td>
                             <td>{{turno.hora_inicio}}</td>
                             <td>{{turno.hora_fin}}</td>
                          </tr>
                         
                       </template>
               </DataTable>
            </template>
            <template #footer>
                <BtnCerrar  @click="close()" style="float:right">
                      X
                </BtnCerrar>
            </template>
        </DialogModal>
</template>