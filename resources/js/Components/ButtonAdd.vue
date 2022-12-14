<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button  :type="type"  class="flex p-2.5 bg-green-600 rounded-xl hover:rounded-3xl hover:bg-green-500 transition-all duration-300">
        <slot />
        </button>
</template>
