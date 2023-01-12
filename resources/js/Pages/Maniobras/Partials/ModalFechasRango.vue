<script setup>
import { ref } from "vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectComponent from "@/Components/SelectComponent.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import ButtonClose from "@/Components/ButtonClose.vue";
import ButtonSave from "@/Components/ButtonSave.vue";
import ButtonDownload from "@/Components/ButtonDownload.vue";

var props = defineProps({
    maniobra_id: Number
});

const formRange =  useForm({
  fechaInicio: null,
  fechaFinal: null
});

const emit = defineEmits(["close"]);

const close = () => {
  emit("close");
};

</script>
<template>
  <DialogModal  @close="close()">
    <template #title>
      <h2 class="p-3 pl-6 -mx-6 text-xl font-bold text-blue-900">Rango de fechas de maniobra {{ props.maniobra_id }}</h2>
    </template>
    <template #content>
      <div class="flex">
         <div class="flex-auto w-64">
            <InputLabel>Fecha inicial</InputLabel>
            <TextInput type="date" v-model="formRange.fechaInicio"></TextInput>
         </div>
         <div class="flex-auto w-64">
            <InputLabel>Fecha final</InputLabel>
            <TextInput type="date" v-model="formRange.fechaFinal"></TextInput>
         </div>
      </div>
      <div class="mt-4">
        <InputLabel>Descargar reporte</InputLabel>
        <a v-if="formRange.fechaInicio && formRange.fechaFinal"  :href="'consultaReporteNominas/'+props.maniobra_id +'/'+formRange.fechaInicio+'/'+formRange.fechaFinal">
            <ButtonDownload class="mt-2">
           </ButtonDownload>
        </a>
      </div>
    </template>
    <template #footer>
      <ButtonClose @click="close()" style="float: right" class="-mr-3 ">
        Cerrar
      </ButtonClose>
    </template>
  </DialogModal>
</template>