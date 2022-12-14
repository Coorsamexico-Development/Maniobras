<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
        <slot />
    </button>
</template>
