<script setup>
import { onMounted, ref } from 'vue';



defineProps({
    modelValue: String | Number,
});

defineEmits(['update:modelValue']);

const select = ref(null);

onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});
defineExpose({ focus: () => input.value.focus() });
</script>
<template>
    <select ref="select" :value="modelValue"
    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-100 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" 
        @input="$emit('update:modelValue', $event.target.value)">
        <slot />
    </select>
</template>

