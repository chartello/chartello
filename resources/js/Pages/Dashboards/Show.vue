<template>
  <Head>
    <title>{{ dashboard.name ?? "Untitled" }}</title>
  </Head>

  <Header>
    <DatePicker />
  </Header>

  <div class="container mx-auto -mt-2 pb-32 lg:flex">
    <Sidebar
      :dashboards="dashboards"
      :show="showSidebar"
      @toggle="showSidebar = !showSidebar"
    />

    <Panels
      :dashboard="dashboard"
      class="flex-1 transition-all duration-500 lg:left-0 lg:w-64"
      :class="{ 'left-0': !showSidebar, 'left-[19rem]': showSidebar }"
      @click="showSidebar = false"
    />
  </div>

  <HelpModal />
</template>

<script setup>
import "v-calendar/dist/style.css";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import HelpModal from "../../Components/HelpModal.vue";
import Header from "../../Components/Header.vue";
import Sidebar from "../../Components/Sidebar.vue";
import DatePicker from "../../Components/DatePicker.vue";
import Panels from "../../Components/Panels.vue";
import { store } from "../../store";

const props = defineProps(["dashboard", "dashboards", "start", "end"]);
store.range.update(props.start, props.end, false);

const showSidebar = ref(false);
</script>
