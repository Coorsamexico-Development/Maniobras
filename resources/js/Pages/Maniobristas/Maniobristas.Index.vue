<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import  TableManiobristas from "../Maniobristas/Partials/TableManiobristas.vue";


const props = defineProps({
    maniobristas:Object,
    filters:Object
});



</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Maniobristas
            </h2>
        </template>
        <div>
            <div class="max-w-screen-xl mx-auto mt-10 sm:px-8 lg:px-10">
                <div class="overflow-hidden  shadow-3xl rounded-3xl">
                    <div>
                         <TableManiobristas :maniobristas="props.maniobristas" :filters="props.filters"></TableManiobristas>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
