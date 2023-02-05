<template>
  <form
    method="POST"
    @submit.prevent="update"
    class="mb-4 overflow-hidden rounded-lg bg-white p-4 shadow"
  >
    <div class="mt-2 mb-6 flex px-4 text-gray-600">
      <div class="flex-1">
        <input
          v-if="editing"
          ref="nameInput"
          type="text"
          v-model="form.name"
          placeholder="Untitled"
          class="w-full border-0 p-0 underline decoration-gray-200 underline-offset-4 focus:decoration-blue-200 focus:ring-0"
        />
        <div v-else-if="form.name" v-text="form.name" />

        <div
          class="mt-1 text-3xl"
          v-text="Intl.NumberFormat().format(panel.aggregate)"
        />
      </div>

      <div class="ml-auto flex items-start pl-4 text-gray-400">
        <IconButton
          v-if="editing && !form.processing"
          @click="remove"
          type="button"
          class="mr-1 text-red-400 hover:bg-red-100"
        >
          <TrashIcon class="h-4 w-4" />
        </IconButton>

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

    <TrendChart :title="form.name" :data="panel.data" />

    <div
      v-if="panel.error"
      class="-mx-4 mt-4 -mb-4 bg-red-50 p-8 text-red-400"
      v-text="panel.error"
    />

    <Editor
      v-show="editing"
      v-model="form.query"
      ref="editor"
      class="-mx-4 mt-4 -mb-4 p-8"
    />
  </form>
</template>

<script setup>
import TrendChart from "./TrendChart.vue";
import Editor from "./Editor.vue";
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Spinner from "../Spinner.vue";
import { PencilIcon, CheckIcon, TrashIcon } from "vue-tabler-icons";
import IconButton from "../IconButton.vue";

const props = defineProps(["panel"]);

const editor = ref(null);

const editing = ref(false);

const form = useForm({
  name: ref(props.panel.name),
  query: ref(props.panel.settings?.query),
});

const nameInput = ref(null);

const params = new Proxy(new URLSearchParams(window.location.search), {
  get: (searchParams, prop) => searchParams.get(prop),
});

if (params.edit == props.panel.id) {
  edit();
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
  form.put(`/${usePage().props.path}/panels/${props.panel.id}`, {
    preserveScroll: true,
    onSuccess: () => (editing.value = false),
  });
}

function remove() {
  form.delete(`/${usePage().props.path}/panels/${props.panel.id}`, {
    preserveScroll: true,
  });
}
</script>
