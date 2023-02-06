<template>
  <Head>
    <title>{{ dashboard.name ?? "Untitled" }}</title>
  </Head>

  <header class="border-b bg-gray-900">
    <div
      class="container mx-auto flex flex-col items-end items-center justify-center px-6 pt-12 pb-12 md:flex-row"
    >
      <Link
        :href="`/${$page.props.path}`"
        class="mb-6 flex items-center justify-center text-xl text-white md:mr-auto md:mb-0"
      >
        <div class="mr-3 h-8 w-8 rounded bg-pink-600 p-2">
          <Logo class="h-4 w-4" />
        </div>

        <h1 class="leading-tight">
          <strong>Chartello</strong>
        </h1>
      </Link>

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
    </div>
  </header>

  <div class="container mx-auto -mt-2 pb-32">
    <div class="lg:flex">
      <div
        class="absolute mr-8 w-64 pt-8 transition-all duration-500 lg:relative lg:left-0"
        :class="{
          'left-[-16rem]': !showLinks,
          'left-[1.5rem] md:left-[calc(50%-22.5rem)]': showLinks,
        }"
      >
        <DashboardLink v-for="link in links" :key="link.id" :dashboard="link" />

        <button
          @click="createDashboard"
          class="mb-2 block flex w-full items-center rounded-xl border-2 border-dashed bg-white bg-white bg-opacity-25 py-2 px-4 text-blue-900 transition hover:border-gray-300 hover:bg-white"
        >
          <PlusIcon class="mr-2 h-4 w-4" />
          Dashboard
        </button>

        <div
          class="fixed bottom-0 left-0 z-10 cursor-pointer rounded-tr bg-blue-100 p-5 text-blue-500 transition hover:bg-blue-200 lg:hidden"
          @click="showLinks = !showLinks"
        >
          <ArrowRightIcon
            class="h-6 w-6 transition"
            :class="{ 'rotate-180': showLinks }"
          />
        </div>
      </div>

      <div
        class="relative flex-1 px-4 transition-all duration-500 lg:left-0 lg:px-0"
        :class="{ 'left-0': !showLinks, 'left-[19rem]': showLinks }"
        @click="showLinks = false"
      >
        <Card
          v-for="panel in dashboard.panels"
          :key="panel.id"
          :panel="panel"
        />

        <button
          @click="createPanel(dashboard)"
          class="mb-2 block flex w-full items-center rounded-xl border-2 border-dashed bg-white bg-opacity-25 py-2 px-4 text-blue-900 transition hover:border-gray-300 hover:bg-white"
          :class="dashboard.panels.length === 0 ? 'mt-8' : ''"
        >
          <PlusIcon class="mr-2 h-4 w-4" />
          Panel
        </button>
      </div>
    </div>
  </div>

  <Modal />
</template>

<script setup>
import { Head, router, usePage, Link } from "@inertiajs/vue3";
import Card from "../../Components/Panels/Card.vue";
import DashboardLink from "../../Components/Dashboards/NavLink.vue";
import { DatePicker } from "v-calendar";
import { ref, watch } from "vue";
import "v-calendar/dist/style.css";
import Modal from "../../Components/HelpModal.vue";
import {
  PlusIcon,
  CalendarIcon,
  MenuIcon,
  ArrowRightIcon,
} from "vue-tabler-icons";
import Logo from "../../Components/Logo.vue";
import NavLink from "../../Components/Dashboards/NavLink.vue";

const props = defineProps(["dashboard", "links", "start", "end"]);

const range = ref({
  start: props.start,
  end: props.end,
});

const showLinks = ref(false);

watch(range, (value) => {
  router.get(`${location.pathname}?start=${value.start}&end=${value.end}`);
});

function createDashboard() {
  router.post(`/${usePage().props.path}/dashboards`);
}

function createPanel(dashboard) {
  router.post(`/${usePage().props.path}/dashboards/${dashboard.id}/panels`);
}
</script>
