<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Graph1 from "@/Components/Graph1.vue";
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Inicio
            </h2>
        </template>

        <div>
            <div class="max-w-screen-xl mx-auto mt-3 sm:px-8 lg:px-10">
                <div class="overflow-hidden shadow-3xl">
                    <Graph1></Graph1>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
