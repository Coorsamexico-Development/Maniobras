<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
     <div class="pt-2 relative mb-5 text-gray-600" style="margin-left: 990px;">

    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>

        </div>
        <input  type="search" name="search" placeholder="Buscar..."  ref="input"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
    </div>
</div>


    <!----<div class="relative p-2 text-gray-600 bg-white shadow-md input-gradiante-blue" style="border-radius:2rem; border: 3px solid gray; background: transparent;" >
        <input type="search" aria-label="Search" placeholder="BUSCAR..."
            class="w-full h-5 px-5 py-1 pr-8 text-sm border-0 focus:ring-0 focus:ring-opacity-50" ref="input"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" style="background:transparent; border: none;">
        <span type="submit" class="absolute right-0 mr-4 top-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 36.48 28.798">
                <defs>
                    <linearGradient id="linear-gradient" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
                        <stop offset="0" stop-color="#80c8c1" />
                        <stop offset="0.52" stop-color="#58a3d3" />
                        <stop offset="0.958" stop-color="#2180d3" />
                    </linearGradient>
                </defs>
                <path id="Trazado_144" data-name="Trazado 144"
                    d="M4071.448,465.22l-10.966-6.576a13.567,13.567,0,1,0-1.487,2.227l11.078,6.643Zm-22.924-2.067a10.881,10.881,0,1,1,10.881-10.881A10.893,10.893,0,0,1,4048.524,463.153Z"
                    transform="translate(-4034.968 -438.716)" fill="url(#linear-gradient)" />
            </svg>
        </span>
    </div>-->
</template>
