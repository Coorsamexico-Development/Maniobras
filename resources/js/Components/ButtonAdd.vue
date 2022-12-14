<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" style="background-color:#0cac5c" 
    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition border border-transparent rounded-full hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
        <slot />
    </button>
</template>
