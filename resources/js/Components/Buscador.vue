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
     <div class="pt-2 relative mx-auto text-gray-600" style="margin-right: 100px;">
        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
          type="search" name="search" placeholder="Buscar..."  ref="input"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" >
            <span type="submit" class="absolute right-0 mr-4 mt-3">
          <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
            width="512px" height="512px">
            <path
              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>
        </span>
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
