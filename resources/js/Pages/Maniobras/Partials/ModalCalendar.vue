<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal2.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import BtnCerrar from '@/Components/BtnCerrar.vue';

import TableManiobristas from './TableManiobristas.vue';
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

let date = ref(null);

let turnoSelect = ref(null);
const selectedTurn = (event, turno) =>
{
    turnoSelect.value = turno;
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
                     <SecondaryButton class="m-2" v-for="turno in turnos" :key="turno.id" @click="selectedTurn($event, turno)">{{turno.name}}</SecondaryButton>
                      <div>
                        <TableManiobristas v-if="date && turnoSelect" :date="date" :turno="turnoSelect"></TableManiobristas>
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