<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import ButtonAdd from '@/Components/ButtonAdd.vue';
import ModalAddManiobra from '../Maniobras/Partials/ModalAddManiobra.vue';
import ManiobrasList from "../Maniobras/Partials/ManiobrasList.vue";


const props=defineProps(
    {
      maniobras:Object,
      clientes:Object,
      status_maniobras:Object
    }
);

/*Modales*/ 
const openModalNewManiobra = ref(false);

const nuevaManiobra = () => 
{
    openModalNewManiobra.value = true;
}

const closeModalNewManiobra = () =>
{
    openModalNewManiobra.value = false;
}


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
              Maniobras
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <ButtonAdd  class="m-6" @click="nuevaManiobra">+</ButtonAdd>
<<<<<<< HEAD
                    <tabla>
                            
                    </tabla>
=======
            
>>>>>>> 059c8f204ad424afa10864df0682f4ce19ce8450
                </div>
            </div>
            <div class="mx-auto" v-for="maniobra in maniobras" :key="maniobra.id">
                <ManiobrasList :maniobra="maniobra"></ManiobrasList>
            </div>       
       </div>
        <ModalAddManiobra :clientes="clientes" :status_maniobras="status_maniobras" :show="openModalNewManiobra" @close="closeModalNewManiobra"></ModalAddManiobra>
    </AppLayout>
</template>