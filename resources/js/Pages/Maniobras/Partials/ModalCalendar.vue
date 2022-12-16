<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal2.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import BtnCloseCalendar from '@/Components/BtnCloseCalendar.vue';
import BtnCalendar from '@/Components/BtnCalendar.vue';
import TableManiobristas from './TableManiobristas.vue';
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

              <div class="grid-cols-3 grid-rows-2 m-2 sm:grid w-80 sm:w-full sm:grid-cols-2 -mb-96 ">
                <div class="border-r-0 border-none sm:border-r-4 sm:border-solid modal_scroll">
                        <div class="hidden sm:grid" >
                          <h3 class="mb-2 ml-56 text-xl font-bold text-blue-900 sm:mr-0">Calendario</h3>
                        </div>

                      
                        <div class="grid grid-cols-3 -mt-10 place-items-center sm:hidden">
                      <BtnCalendar class="p-1 text-xs" v-for="turno in turnos" :key="turno.id" @click="selectedTurn($event, turno)">{{turno.name}}</BtnCalendar>
                     </div>

                        <div class="hidden mr-10 sm:grid" >
                          <DatePicker is-expanded :rows="12"  v-model="date"/> 
                        </div>

                        <div class="mt-10 ml-16 -mb-96 sm:hidden">
                          <DatePicker :rows="1"  v-model="date"/> 
                        </div>

                        
                </div>
                <div class=" modal_scroll -mb-96 sm:hidden">
                  <div class="mt-10 ml-16 -mb-96 sm:hidden">
                    <div>
                        <TableManiobristas v-if="date && turnoSelect" :date="date" :turno="turnoSelect"></TableManiobristas>
                      </div>
                        </div>
                </div>
    

                <div>
                   <div class="hidden modal_scroll sm:grid ">
                    <div class="grid grid-cols-3 gap-5 m-5 text-center -mt-36 place-items-center">
                      <BtnCalendar class="p-4" v-for="turno in turnos" :key="turno.id" @click="selectedTurn($event, turno)">{{turno.name}}</BtnCalendar>
                    </div>
                      <div>
                        <TableManiobristas v-if="date && turnoSelect" :date="date" :turno="turnoSelect"></TableManiobristas>
                      </div>
                   </div>
                </div>

              </div>

            </template>
            <template #footer>
              <BtnCloseCalendar  @click="close()" style="float:right">
                      X
              </BtnCloseCalendar>
            </template>
        </DialogModal>
</template>