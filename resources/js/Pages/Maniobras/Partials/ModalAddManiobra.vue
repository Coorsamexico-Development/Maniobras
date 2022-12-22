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

var props = defineProps({
  clientes: Object,
  status_maniobras: Object,
});

const formManiobra = useForm({
  name: "",
  descripcion: "",
  salario: 0,
  cliente_id: -1,
  status_maniobra_id: -1,
});

const enviarFormManiobra = () => {
  formManiobra.post(route("maniobras.store"), {
    onSuccess: () => close(),
    onFinish: () => formManiobra.reset(),
  });
};

const emit = defineEmits(["close"]);

const close = () => {
  emit("close");
};
</script>
<template>
  <DialogModal :show="show" @close="close()">
    <template #title>
      <h2 class="p-3 pl-6 -mx-6 text-xl font-bold text-blue-900">Nueva maniobra</h2>
    </template>
    <template #content>
      <form class="w-full">
        <div class="flex flex-wrap mb-6 -mx-3 mr-15">
          <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
            <InputLabel
              class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase "
              >Nombre de maniobra</InputLabel
            >
            <TextInput
              required
              v-model="formManiobra.name"
              class="block w-full px-4 py-3 mb-3 leading-tight text-gray-500 bg-gray-100 border rounded appearance-none focus:outline-none focus:bg-white"
            ></TextInput>
          </div>
          <div class="w-full px-3 md:w-1/2">
            <InputLabel
              class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase "
              >Descripción</InputLabel
            >
            <TextInput
              required
              v-model="formManiobra.descripcion"
              class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-100 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            ></TextInput>
          </div>
        </div>

        <div class="flex flex-wrap mb-2 -mx-3">
          <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
            <InputLabel
              class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase "
              >Salario</InputLabel
            >
            <TextInput
              required
              v-model="formManiobra.salario"
              type="number"
              class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-100 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            ></TextInput>
          </div>
          <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
            <InputLabel
              class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase "
              >Cliente</InputLabel
            >
            <SelectComponent v-model="formManiobra.cliente_id">
              <option disabled selected>Seleccciona un cliente</option>
              <option
                class="text-black"
                v-for="cliente in clientes"
                :key="cliente.id"
                :value="cliente.id"
              >
                {{ cliente.name }}
              </option>
            </SelectComponent>
          </div>
          <div class="w-full px-3 mb-6 md:w-1/3 md:mb-0">
            <InputLabel
              class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase "
              >Status</InputLabel
            >
            <SelectComponent v-model="formManiobra.status_maniobra_id">
              <option disabled selected>Seleccciona un status</option>
              <option
                class="text-black"
                v-for="status in status_maniobras"
                :key="status.id"
                :value="status.id"
              >
                {{ status.name }}
              </option>
            </SelectComponent>
          </div>
        </div>
      </form>

      <div class="float-right m-4 mt-8 -mr-1">
        <ButtonSave @click="enviarFormManiobra()" >Guardar </ButtonSave>
      </div>
    </template>
    <template #footer>
      <ButtonClose @click="close()" style="float: right" class="-mr-3 ">
        Cerrar
      </ButtonClose>
    </template>
  </DialogModal>
</template>