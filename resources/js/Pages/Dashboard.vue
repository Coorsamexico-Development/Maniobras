<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import Tabla from "@/Components/ManiobrasList.vue";
//import Tabla from "@/Components/Tabla.vue";

</script>


<template>
    <AppLayout title="Dashboard">
        <!---<template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Inicio
            </h2>
        </template>-->

        <div>
            <div class="max-w-screen-xl mx-auto mt-3 sm:px-8 lg:px-10">
                <div class="overflow-hidden bg-white shadow-3xl">
                    <div>
                        <div class="p-5 text-center">
                            <h1 class="text-4xl text-blue-900">Maniobras</h1>
                        </div>
                        <div   class="flex justify-center px-3 py-4">
                           <tabla>
                            
                           </tabla>
                           <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
