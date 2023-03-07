<template>
  <form
    method="POST"
    class="mb-2 flex items-center rounded-lg px-4 text-blue-900 transition"
    :class="{ 'bg-blue-100': active, ' hover:bg-gray-100': !active }"
    @submit.prevent="update"
  >
    <InlineInput
      v-if="editing"
      v-model="form.name"
      ref="input"
      placeholder="Untitled"
      class="w-full flex-1 py-2"
    />
    <Link
      v-else
      class="flex-1 py-2"
      :href="url"
      v-text="form.name ? form.name : 'Untitled'"
      @click="loading = true"
    />

    <template v-if="active">
      <IconButton
        v-if="editing && !form.processing"
        @click="remove"
        type="button"
        class="mr-1 text-red-400 hover:bg-red-100"
      >
        <TrashIcon class="h-4 w-4" />
      </IconButton>

      <Spinner v-if="form.processing" class="ml-2" />

      <IconButton
        v-else-if="editing"
        @click="update"
        class="text-blue-500 hover:bg-blue-200"
      >
        <CheckIcon class="h-4 w-4" />
      </IconButton>

      <IconButton v-else @click="edit" class="text-blue-500 hover:bg-blue-200">
        <PencilIcon class="h-4 w-4" />
      </IconButton>
    </template>
    <template v-else>
      <Spinner class="text-gray-400" v-if="loading" />
    </template>
  </form>
</template>

<script setup>
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { PencilIcon, CheckIcon, TrashIcon } from "vue-tabler-icons";
import { computed, onMounted, ref, watch } from "vue";
import Spinner from "./Spinner.vue";
import IconButton from "./IconButton.vue";
import InlineInput from "./InlineInput.vue";

const props = defineProps(["dashboard"]);

const editing = ref(false);

const url = computed(() => {
  return `${usePage().props.path}/dashboards/${props.dashboard.id}`;
});

const pathname = computed(() => {
  return new URL(url.value).pathname;
});

const active = computed(() => {
  let current = usePage().url;

  current =
    current.indexOf("?") === -1
      ? current
      : current.substring(0, current.indexOf("?"));

  return current === pathname.value;
});

const form = useForm({
  name: ref(props.dashboard.name),
});

const input = ref(null);

const loading = ref(false);

function edit() {
  editing.value = true;
  setTimeout(() => input.value.focus(), 50);
}

function update() {
  form.put(url.value, {
    preserveScroll: true,
    onSuccess: () => (editing.value = false),
  });
}

function remove() {
  form.delete(url.value, {
    preserveScroll: true,
  });
}

watch(active, (value) => {
  if (!value) {
    editing.value = false;
  }
});

onMounted(() => {
  if (active.value && props.dashboard.name === null) {
    edit();
  }
});

router.on("start", (event) => {
  loading.value = event.detail.visit.url.pathname === pathname.value;
});
</script>
