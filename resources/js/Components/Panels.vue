<template>
  <div class="relative px-4 lg:px-0">
    <Panel v-for="panel in dashboard.panels" :key="panel.id" :panel="panel" />

    <ButtonAdd
      @click="store.panels.create(dashboard)"
      class="mb-2 w-full"
      :class="dashboard.panels.length === 0 ? 'mt-8' : ''"
    >
      Panel
    </ButtonAdd>
  </div>
</template>

<script setup>
import Panel from "./Panel.vue";
import { store } from "../store";
import ButtonAdd from "./ButtonAdd.vue";

defineProps({
  dashboard: Object,
});
</script>
