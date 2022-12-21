<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>

    <button :type="type" class="inline-block px-5 py-2 text-xs font-bold leading-tight text-white uppercase transition duration-150 ease-in-out bg-gray-500 rounded shadow-md mt-96 sm:mt-0 hover:bg-gray-600 hover:shadow-lg focus:bg-gray-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-500 active:shadow-lg">
        <slot />
    </button>
</template>
