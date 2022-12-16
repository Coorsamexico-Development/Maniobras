<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex px-7 ml-48 mt-10 sm:mt-0 sm:ml-0 sm:px-3 sm:py-1.5 mr-48 text-lg  tracking-widest text-center text-white transition bg-blue-800 border border-blue-300 shadow-sm lg:items-center hover:bg-blue-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 disabled:opacity-25 rounded-3xl sm:mr-0 ">
        <slot />
    </button>
</template>
