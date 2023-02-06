<template>
  <button
    class="flex items-center rounded-xl border-2 border-dashed bg-white bg-opacity-25 py-2 px-4 text-blue-900 transition hover:border-gray-300 hover:bg-white"
  >
    <PlusIcon class="mr-2 h-4 w-4" />
    <slot />
  </button>
</template>

<script setup>
import { PlusIcon } from "vue-tabler-icons";
</script>
