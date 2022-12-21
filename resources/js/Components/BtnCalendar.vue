<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="px-5 py-3 ml-48  sm:mt-16 sm:ml-0 sm:px-3 sm:py-1.5 mr-48 sm:text-md text-white transition-transform transform btn_calendar rounded-md shadow-lg outline-none focus:ring-4 active:scale-75 sm:mr-0 ">
        <slot />
    </button>
</template>

