<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal2.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import BtnCerrar from '@/Components/BtnCerrar.vue';
import { Inertia } from '@inertiajs/inertia';
import TableManiobristas from './TableManiobristas.vue';
import { useForm } from '@inertiajs/inertia-vue3' 
import 'v-calendar/dist/style.css';
import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';

var props = defineProps({
  turnos:Object,
  maniobra_id:Number,
  maniobristas: Object
});

const emit = defineEmits(["close",])

const close = () => {
        
        emit('close');
    };

let date = ref(null);

let turnoSelect = ref(null);
const selectedTurn = (turno) =>
{
    //console.log(turno);
    turnoSelect.value = turno.id;

    if(date.value != null)
    {
         let formatDate = new Date(date.value);
         const dia = formatDate.getDate();
         const mes = formatDate.getMonth()+1;
         const año = formatDate.getFullYear();

        let fechaCompleta = año+'-'+mes+'-'+dia;
         Inertia.visit(route('maniobras'), {
          data: {
            turno_id :turnoSelect.value,
            fecha: fechaCompleta
         },
          preserveState: true,
          preserveScroll: true,
          only: ['maniobristas'],
      })
    }
}




</script>
<template>
     <DialogModal  :show="show" @close="close()" >
           <template #title>

            </template>
            <template #content >
              <div class="grid grid-cols-2 m-2">
                <div class="border-r-4 border-solid" style="overflow-y: scroll;height: 30rem;">
                        <h3 class="text-center">Calendario</h3>
                        <DatePicker is-expanded :rows="12"  v-model="date"/> 
                </div>
                <div >
                   <div  style="overflow-y: scroll;height: 30rem;">
                     <SecondaryButton class="m-2" v-for="turno in turnos" :key="turno.id" @click="selectedTurn(turno)">{{turno.name}}</SecondaryButton>
                      <div>
                        <TableManiobristas :maniobristas="maniobristas" v-if="date && turnoSelect" :date="date" :turno="turnoSelect"></TableManiobristas>
                      </div>
                   </div>
                </div>
              </div>
            </template>
            <template #footer>
              <BtnCerrar  @click="close()" style="float:right">
                      X
                </BtnCerrar>
            </template>
        </DialogModal>
</template>