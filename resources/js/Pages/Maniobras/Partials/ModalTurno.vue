<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
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
              Turnos
            </template>
            <template #content >
                <DataTable>
                   <template #section-header>
                       <slot name="section-header">
                        
                       </slot>
                   </template>
                   <template #table-header>
                           <tr class="text-center text-md" >
                               <th scope="col" class="px-2 py-1 text-sm font-semibold tracking-wider uppercase cursor-pointer ">
                                   <span>
                                       Turno 
                                   </span>
                               </th>
                               <th class="px-2 py-1 text-sm font-semibold tracking-wider uppercase cursor-pointer "> 
                                   Hora Inicio
                               </th>
                               <th class="px-2 py-1 text-sm font-semibold tracking-wider uppercase cursor-pointer ">
                                   Hora Fin
                               </th>
                           </tr>
                       </template>
                       <template #table-body>
                          <tr v-for="turno in turnos" :key="turno.id">
                             <td> {{turno.name}}</td>
                             <td>{{turno.hora_inicio}}</td>
                             <td>{{turno.hora_fin}}</td>
                          </tr>
                         
                       </template>
               </DataTable>
            </template>
            <template #footer>
                <SecondaryButton  @click="close()" style="float:right">
                      Cerrar
                </SecondaryButton>
            </template>
        </DialogModal>
</template>