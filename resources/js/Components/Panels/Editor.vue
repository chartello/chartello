<template>
  <div class="relative flex bg-[#f3f3f3]">
    <div ref="element" v-text="originalValue" class="relative flex-1" />

    <span
      v-show="!modelValue"
      class="top-50 pointer-events-none absolute opacity-[0.15]"
      >Write a query...</span
    >

    <IconButton
      @click="store.helpModal.open()"
      type="button"
      class="text-gray-400 hover:bg-gray-200"
    >
      <InfoCircleIcon class="h-4 w-4" />
    </IconButton>
  </div>
</template>

<script setup>
import { CodeJar } from "codejar";
import hljs from "highlight.js";
import "highlight.js/styles/default.css";
import { onMounted, ref } from "vue";
import { InfoCircleIcon } from "vue-tabler-icons";
import { store } from "../../store";
import IconButton from "../IconButton.vue";

const props = defineProps(["modelValue", "autofocus"]);

const emit = defineEmits(["update:modelValue"]);

const element = ref(null);

const originalValue = props.modelValue;

function focus() {
  element.value.focus();
}

onMounted(() => {
  const jar = CodeJar(element.value, hljs.highlightElement);
  jar.onUpdate((code) => {
    emit("update:modelValue", code);
  });
});

defineExpose({ focus });
</script>
