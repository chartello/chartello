<template>
  <div class="-mx-4 mb-4">
    <table class="w-full text-left">
      <thead>
        <tr class="text-blue-400 grayscale-[0.3]">
          <th
            v-for="(column, key) in panel.data[0]"
            class="px-4 py-3 pl-8 text-sm font-normal"
            v-text="key"
          />
        </tr>
      </thead>
      <tbody class="text-gray-500">
        <tr v-for="row in panel.data" class="border-t border-gray-100">
          <td
            v-for="(column, key, i) in row"
            class="px-4 py-3"
            :class="{ 'pl-8': i === 0, 'pr-8': i === row.length }"
            v-text="column"
          />
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps(["form", "panel"]);
</script>
