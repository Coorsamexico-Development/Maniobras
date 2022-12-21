<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>


    <button :type="type" class="inline-flex items-center px-2 py-2.5 mt-1 text-xs font-bold text-white uppercase bg-green-600 border-b-2 border-gray-500 shadow-md rounded-xl hover:border-green-500 hover:bg-green-500 ">


      <slot />
    </button>
</template>