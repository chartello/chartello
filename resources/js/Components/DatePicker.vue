<template>
  <DatePicker
    v-model="range"
    is-range
    :model-config="{ type: 'string', mask: 'YYYY-MM-DD' }"
    :columns="$screens({ default: 1, md: 2 })"
  >
    <template v-slot="{ inputValue, inputEvents, showPopover }">
      <div class="relative flex items-center justify-end rounded bg-white">
        <input
          :value="inputValue.start"
          v-on="inputEvents.start"
          class="w-32 rounded px-4 py-1 text-center focus:border-indigo-300 focus:outline-none"
        />

        <span>-</span>

        <input
          :value="inputValue.end"
          v-on="inputEvents.end"
          class="w-40 rounded pl-4 pr-8 text-center focus:border-indigo-300 focus:outline-none"
        />

        <CalendarIcon
          class="pointer-events-none absolute right-4 h-4 w-4 text-gray-400"
        />
      </div>
    </template>
  </DatePicker>
</template>

<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { DatePicker } from "v-calendar";
import { CalendarIcon } from "vue-tabler-icons";

const props = defineProps({
  start: String,
  end: String,
});

const range = ref({
  start: props.start,
  end: props.end,
});

watch(range, (value) => {
  router.get(`${location.pathname}?start=${value.start}&end=${value.end}`);
});
</script>
