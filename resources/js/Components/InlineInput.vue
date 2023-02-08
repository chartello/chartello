<template>
  <input
    :type="type"
    :value="modelValue"
    ref="element"
    class="border-0 bg-transparent p-0 underline decoration-gray-200 underline-offset-4 focus:decoration-blue-200 focus:ring-0"
    @input="emit('update:modelValue', $event.target.value)"
  />
</template>

<script setup>
import { ref } from "vue";

defineProps({
  modelValue: String,
  type: {
    default: "text",
  },
});

const emit = defineEmits("update:modelValue");

const element = ref(null);

function focus() {
  element.value.focus();
}

defineExpose({ focus });
</script>
