<template>
  <aside
    class="absolute mr-8 w-64 pt-8 transition-all duration-500 lg:relative lg:left-0"
    :class="{
      'left-[-16rem]': !show,
      'left-[1.5rem] md:left-[calc(50%-22.5rem)]': show,
    }"
  >
    <DashboardLink v-for="link in links" :key="link.id" :dashboard="link" />

    <ButtonAdd @click="store.dashboards.create()" class="mb-2 w-full">
      Dashboard
    </ButtonAdd>

    <div
      class="fixed bottom-0 left-0 z-10 cursor-pointer rounded-tr bg-blue-100 p-5 text-blue-500 transition hover:bg-blue-200 lg:hidden"
      @click="emit('toggle')"
    >
      <ArrowRightIcon
        class="h-6 w-6 transition"
        :class="{ 'rotate-180': show }"
      />
    </div>
  </aside>
</template>

<script setup>
import DashboardLink from "./NavLink.vue";
import { ArrowRightIcon } from "vue-tabler-icons";
import { store } from "../store";
import ButtonAdd from "./ButtonAdd.vue";

defineProps({
  links: Array,
  show: Boolean,
});

const emit = defineEmits(["toggle"]);
</script>
