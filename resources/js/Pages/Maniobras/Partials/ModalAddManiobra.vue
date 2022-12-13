<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectComponent from '@/Components/SelectComponent.vue';
import { useForm } from '@inertiajs/inertia-vue3' 

var props = defineProps({
   clientes:Object,
   status_maniobras:Object
});

const formManiobra = useForm({
          name:"",
          descripcion:"",
          salario:0,
          cliente_id:-1,
          status_maniobra_id:-1
          });

const enviarFormManiobra = () => 
{
    formManiobra.post(route('maniobras.store'), {
        onSuccess: () => close(),
        onFinish: () => formManiobra.reset(),
    }); 
}

const emit = defineEmits(["close",])

const close = () => {
        
        emit('close');
    };

</script>
<template>
     <DialogModal :show="show" @close="close()">
           <template #title>
               <h2>Nueva maniobra</h2>
            </template>
            <template #content>
               <form>
                   <div>
                      <InputLabel>Nombre de maniobra</InputLabel>
                      <TextInput required v-model="formManiobra.name"></TextInput>
                   </div>
                   <div>
                      <InputLabel>Descripcion</InputLabel>
                      <TextInput required v-model="formManiobra.descripcion"></TextInput>
                   </div>
                   <div>
                      <InputLabel>Salario</InputLabel>
                      <TextInput required v-model="formManiobra.salario" type="number"></TextInput>
                   </div>
                   <div>
                      <InputLabel>Cliente</InputLabel>
                      <SelectComponent v-model="formManiobra.cliente_id">
                        <option disabled selected>Seleccciona un cliente</option>
                        <option class="text-black" v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                            {{cliente.name}}
                        </option>
                      </SelectComponent>
                   </div>
                   <div>
                      <InputLabel>Status</InputLabel>
                      <SelectComponent v-model="formManiobra.status_maniobra_id">
                        <option disabled selected>Seleccciona un status</option>
                        <option class="text-black" v-for="status in status_maniobras" :key="status.id" :value="status.id">
                            {{status.name}}
                        </option>
                      </SelectComponent>
                   </div>
                  <div class="float-right m-4">
                    <SecondaryButton  @click="enviarFormManiobra()">
                      Enviar
                      </SecondaryButton>
                  </div>

                 
               </form>
            </template>
            <template #footer>
                <SecondaryButton  @click="close()" style="float:right">
                      Cerrar
                </SecondaryButton>
            </template>
        </DialogModal>
</template>