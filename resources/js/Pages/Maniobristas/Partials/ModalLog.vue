<script setup>
import { ref, computed } from "vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectComponent from "@/Components/SelectComponent.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import ButtonClose from "@/Components/ButtonClose.vue";
import ButtonSave from "@/Components/ButtonSave.vue";
import { usePage } from '@inertiajs/inertia-vue3';


const emit = defineEmits(["close"]);
var props = defineProps({
  show:Boolean,
  maniobrista:Object
});

let fechaActual = new Date();
const añoActual = fechaActual.getFullYear();
const hoy = fechaActual.getDate();
const mesActual = fechaActual.getMonth() + 1; 

let stringhoy = hoy.toString();
let stringMesActual = mesActual.toString();

let newMesActual;
if(stringMesActual.length > 1)
{
  newHoyActual = stringMesActual;
  //console.log(true);
}
else
{
  newMesActual = 0+stringMesActual;
  //console.log(false);
}

let newHoyActual;
if(stringhoy.length > 1)
{
    newHoyActual = stringhoy;
   // console.log(true);
}
else
{
    newHoyActual = 0+stringhoy;
   // console.log(false);
}


//console.log(añoActual+'-'+newMesActual+'-'+newHoyActual);
let fechaActualString = computed(() => {
    let fechaAux = añoActual+'-'+newMesActual+'-'+newHoyActual;
    return fechaAux;
});
// añoActual+'-'+newMesActual+'-'+newHoyActual

const user = usePage().props.value.user;

const formDesac = useForm({
  maniobrista_id:props.maniobrista.id,
  user_id: user.id,
  fecha: fechaActualString,
  descripcion:""
});

const close = () => {
  emit("close");
};

const enviarFormManiobra = () => 
{
  formDesac.post(route("logActivos.store"), {
    onSuccess: () => close(),
    onFinish: () => formManiobra.reset(),
  });
}
</script>
<template>
  <DialogModal :show="show" @close="close()">
    <template #title>
      <h2 class="p-3 pl-6 -mx-6 text-xl font-bold text-blue-900">Log de maniobrista</h2>
    </template>
    <template #content>
       <form>
          <div class="grid grid-cols-2">
             <div class="">
                <InputLabel>Maniobrista</InputLabel>
                <input disabled v-bind:value="maniobrista.name+' '+maniobrista.ap_paterno + ' '+ maniobrista.ap_materno">
             </div>
             <div class=""> 
                <InputLabel>Fecha de desactivación:</InputLabel>
                <TextInput v-model="formDesac.fecha" type="date"></TextInput>
             </div>
             <div class="">
                <InputLabel>Motivo de baja</InputLabel>
                <textarea rows="5" cols="70" v-model="formDesac.descripcion"></textarea>
             </div>
          </div>
       </form>
      <div class="float-right m-4 mt-8 -mr-1">
        <ButtonSave @click="enviarFormManiobra()" >Guardar </ButtonSave>
      </div>
    </template>
    <template #footer>

    </template>
  </DialogModal>
</template>