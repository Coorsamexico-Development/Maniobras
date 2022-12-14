<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/inertia-vue3' 
import 'v-calendar/dist/style.css';
import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';



var props = defineProps({
  turnos:Object
});

const emit = defineEmits(["close",])

const close = () => {
        
        emit('close');
    };

let date = ref(null);


</script>
<template>
     <DialogModal style="width:10rem" :show="show" @close="close()" :maxWidth="maxWidth">
           <template #title>
             
            </template>
            <template #content>
              <div class="grid grid-cols-2">
                <div class="border-r-4 border-solid snap-y">
                    <div class="snap-center">
                        <h3 class="text-center">Calendario</h3>
                        <DatePicker class="" is-expanded :rows="12"  v-model="date" />
                    </div>
                </div>
                <div class="">
                   <div class="grid-cols-3">
                     <SecondaryButton class="m-2" v-for="turno in turnos" :key="turno.id">{{turno.name}}</SecondaryButton>
                   </div>
                </div>
              </div>
            </template>
            <template #footer>
                <SecondaryButton  @click="close()" style="float:right">
                      Cerrar
                </SecondaryButton>
            </template>
        </DialogModal>
</template>