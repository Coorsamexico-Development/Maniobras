<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button class="inline-flex items-center px-2 py-2 font-bold text-gray-500 border-b-2 border-gray-400 shadow-md rounded-xl hover:border-gray-500 hover:bg-gray-200 ">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
       <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
      </svg>
      <slot />
    </button>
</template>
