<template>
  <div class="-mx-4 mb-4 w-full overflow-x-auto">
    <table v-if="panel.data.length" class="w-full text-left">
      <thead>
        <tr class="text-blue-400 grayscale-[0.3]">
          <th
            v-for="(column, key, i) in panel.data[0]"
            class="px-4 py-3 text-sm font-normal"
            :class="{ 'pl-8': i === 0, 'pr-8': i === panel.data[0].length }"
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
    <div class="mt-4 px-8 text-gray-400" v-else>No records found.</div>
  </div>
</template>

<script setup>
defineProps(["form", "panel"]);
</script>
