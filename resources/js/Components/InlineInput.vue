<template>
  <input
    :type="type"
    class="border-0 p-0 underline decoration-gray-200 underline-offset-4 focus:decoration-blue-200 focus:ring-0"
  />
</template>

<script setup>
defineProps({
  type: {
    default: "text",
  },
});
</script>
