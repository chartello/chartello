<template>
  <input
    :type="type"
    ref="element"
    class="border-0 bg-transparent p-0 underline decoration-gray-200 underline-offset-4 focus:decoration-blue-200 focus:ring-0"
  />
</template>

<script setup>
import { ref } from "vue";

defineProps({
  type: {
    default: "text",
  },
});

const element = ref(null);

function focus() {
  element.value.focus();
}

defineExpose({ focus });
</script>
