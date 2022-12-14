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
      status_maniobras:Object,
      maniobristas:Object
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
                    <ButtonAdd  class="m-6 " @click="nuevaManiobra"> <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="inline-block w-6 h-6">
                          <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
                          </svg>
                   </ButtonAdd>
                   
                </div>
            </div>
            <div class="ml-10 mr-10" v-for="maniobra in maniobras" :key="maniobra.id">
                <ManiobrasList :maniobra="maniobra" :maniobristas="maniobristas"></ManiobrasList>
            </div>       
       </div>
        <ModalAddManiobra :clientes="clientes" :status_maniobras="status_maniobras" :show="openModalNewManiobra" @close="closeModalNewManiobra"></ModalAddManiobra>
    </AppLayout>
</template>