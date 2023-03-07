<template>
  <form
    method="POST"
    @submit.prevent="update"
    class="mb-4 overflow-hidden rounded-lg bg-white p-4 shadow"
  >
    <div class="mt-2 mb-1 flex px-4 text-gray-600">
      <div class="flex-1">
        <InlineInput
          v-if="editing"
          ref="nameInput"
          v-model="form.name"
          placeholder="Untitled"
          class="w-full"
        />
        <div v-else-if="form.name" v-text="form.name" />
      </div>

      <div class="ml-auto flex items-start pl-4 text-gray-400">
        <template v-if="editing && !form.processing">
          <IconButton
            @click="remove"
            type="button"
            class="mr-1 text-red-400 hover:bg-red-100"
          >
            <TrashIcon class="h-4 w-4" />
          </IconButton>

          <div v-for="(value, key) in types">
            <IconButton
              type="button"
              class="mr-1 text-gray-400"
              :class="{
                'bg-gray-200': type.label === value.label,
                'hover:bg-gray-100': type.label !== value.label,
              }"
              @click="form.type = key"
            >
              <component :is="value.icon" class="h-4 w-4" />
            </IconButton>
          </div>
        </template>

        <Spinner v-if="form.processing" />

        <IconButton
          v-else-if="!editing"
          type="button"
          @click="edit"
          class="text-gray-400 hover:bg-gray-100"
        >
          <PencilIcon class="h-4 w-4" />
        </IconButton>

        <IconButton v-else class="text-gray-400 hover:bg-gray-100">
          <CheckIcon class="h-4 w-4" />
        </IconButton>
      </div>
    </div>

    <component
      :is="type.component"
      :form="form"
      :panel="panel"
      :editing="editing"
    />

    <div
      v-if="panel.error"
      class="-mx-4 mt-4 -mb-4 bg-red-50 p-8 text-red-400"
      v-text="panel.error"
    />

    <Editor
      v-show="editing"
      v-model="form.query"
      ref="editor"
      class="-mx-4 mt-4 -mb-4 p-4 text-lg"
    >
      <template v-slot:append>
        <IconButton
          @click="help()"
          type="button"
          class="text-gray-400 hover:bg-gray-200"
        >
          <InfoCircleIcon class="h-4 w-4" />
        </IconButton>
      </template>
    </Editor>
  </form>
</template>

<script setup>
import { computed, ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import {
  PencilIcon,
  CheckIcon,
  TrashIcon,
  ChartLineIcon,
  BorderAllIcon,
  InfoCircleIcon,
} from "vue-tabler-icons";
import IconButton from "./IconButton.vue";
import TrendChart from "./Panels/TrendChart.vue";
import Editor from "./Editor.vue";
import Spinner from "./Spinner.vue";
import InlineInput from "./InlineInput.vue";
import Table from "./Panels/Table.vue";
import { store } from "../store";

const types = {
  "trend-chart": {
    label: "Trend Chart",
    component: TrendChart,
    icon: ChartLineIcon,
    help: {
      title: "Writing a query for a trend chart",
      body: "TrendChartQueryGuide",
    },
  },
  table: {
    label: "Table",
    component: Table,
    icon: BorderAllIcon,
    help: {
      title: "Writing a query for a table",
      body: "TableQueryGuide",
    },
  },
};

const props = defineProps(["panel"]);

const editor = ref(null);

const editing = ref(false);

const form = useForm({
  name: ref(props.panel.name),
  type: ref(props.panel.type),
  query: ref(props.panel.settings?.query),
});

const type = computed(() => types[form.type] ?? types["trend-chart"]);

const nameInput = ref(null);

const params = new Proxy(new URLSearchParams(window.location.search), {
  get: (searchParams, prop) => searchParams.get(prop),
});

if (parseInt(params.edit) === parseInt(props.panel.id)) {
  edit();
}

function help() {
  store.helpModal.open(type.value.help.title, type.value.help.body);
}

function edit() {
  editing.value = true;

  if (!form.query) {
    setTimeout(() => editor.value.focus(), 50);
    return;
  }

  if (!form.name) {
    setTimeout(() => nameInput.value.focus(), 50);
  }
}

function update() {
  form.put(`${usePage().props.path}/panels/${props.panel.id}`, {
    preserveScroll: true,
    onSuccess: () => (editing.value = false),
  });
}

function remove() {
  form.delete(`${usePage().props.path}/panels/${props.panel.id}`, {
    preserveScroll: true,
  });
}
</script>
