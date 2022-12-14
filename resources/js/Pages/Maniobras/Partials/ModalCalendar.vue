<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/inertia-vue3' 

var props = defineProps({
   clientes:Object,
   status_maniobras:Object
});

const emit = defineEmits(["close",])

const close = () => {
        
        emit('close');
    };

</script>
<template>
     <DialogModal :show="show" @close="close()">
           <template #title>
    
            </template>
            <template #content>

            </template>
            <template #footer>
                <SecondaryButton  @click="close()" style="float:right">
                      Cerrar
                </SecondaryButton>
            </template>
        </DialogModal>
</template>