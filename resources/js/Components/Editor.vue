<template>
  <div class="relative flex bg-[#f3f3f3]">
    <div ref="element" class="relative flex-1" />

    <slot name="append"></slot>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { basicSetup, EditorView } from "codemirror";
import { sql } from "@codemirror/lang-sql";
import { placeholder } from "@codemirror/view";
import { usePage } from "@inertiajs/vue3";

const props = defineProps(["modelValue", "autofocus"]);

const emit = defineEmits(["update:modelValue"]);

const element = ref(null);

const originalValue = props.modelValue;

let editor = null;

function focus() {
  if (editor) {
    editor.focus();
  }
}

onMounted(() => {
  editor = new EditorView({
    doc: originalValue,
    extensions: [
      basicSetup,
      placeholder("Write a query..."),
      sql({
        schema: usePage().props.schema,
      }),
      EditorView.updateListener.of((event) => {
        if (event.docChanged) {
          emit("update:modelValue", event.state.doc.toString());
        }
      }),
    ],
    parent: element.value,
  });
});

defineExpose({ focus });
</script>

<style>
.ͼ1.cm-focused {
  outline: none;
}

.ͼ2 .cm-activeLine,
.ͼ2 .cm-activeLineGutter {
  background: transparent;
}

.ͼ2 .cm-gutters {
  color: #d5d5d5;
  border: none;
}

.ͼ1 .cm-placeholder {
  color: #d5d5d5;
}
</style>
