<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex px-4 text-lg font-semibold tracking-widest text-white uppercase transition bg-red-600 border border-red-300 shadow-sm mr-44 mt-96 sm:mt-0 lg:items-center hover:bg-red-500 focus:outline-none focus:border-red-300 focus:ring focus:ring-blue-200 disabled:opacity-25 rounded-2xl sm:mr-0">
        <slot />
    </button>
</template>
