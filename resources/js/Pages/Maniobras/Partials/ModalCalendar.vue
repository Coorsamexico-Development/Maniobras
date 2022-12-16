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
            <template #content>

              <div class="grid-cols-1 grid-rows-2 m-2 sm:grid w-80 sm:w-full sm:grid-cols-2 -mb-96">
                <div class="border-r-0 border-none sm:border-r-4 sm:border-solid modal_scroll">
                        <div class="hidden sm:grid" >
                          <h3 class="mr-12 text-center sm:mr-0">Calendario</h3>
                        </div>

                        <div class="hidden sm:grid" >
                          <DatePicker is-expanded :rows="12"  v-model="date"/> 
                        </div>

                        <div class="mt-10 sm:hidden">
                          <DatePicker :rows="1"  v-model="date"/> 
                        </div>
                </div>

                
                
                <div >
                   <div  class="modal_scroll">
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