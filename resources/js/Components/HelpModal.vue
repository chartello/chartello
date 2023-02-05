<template>
  <TransitionRoot appear :show="store.helpModal.isOpen" as="template">
    <Dialog as="div" @close="store.helpModal.close()" class="relative z-10">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                Writing a query for a trend chart
              </DialogTitle>
              <div class="mt-2 text-gray-500">
                <p class="mb-2">
                  When writing a query for a trend chart, you should:
                </p>

                <ul class="mb-6 list-inside list-disc">
                  <li>Select a date value aliased as <strong>x</strong></li>
                  <li>Select a numeric value aliased as <strong>y</strong></li>
                  <li>
                    Include a
                    <code
                      class="hljs language-pgsql inline-block bg-[#f3f3f3] px-1"
                      ><span class="hljs-keyword">BETWEEN</span> @<span
                        class="hljs-keyword"
                        >start</span
                      >
                      <span class="hljs-keyword">AND</span> @<span
                        class="hljs-keyword"
                        >end</span
                      ></code
                    >
                    filter
                  </li>
                </ul>

                <p class="mb-2">Example:</p>
                <div class="rounded bg-[#f3f3f3] p-4">
                  <div class="hljs language-pgsql relative flex-1">
                    <span class="hljs-keyword">SELECT</span> COUNT(*)
                    <span class="hljs-keyword">AS</span> y,<br />
                    <span class="hljs-type">DATE</span>(created_at)
                    <span class="hljs-keyword">AS</span> x<br />
                    <span class="hljs-keyword">FROM</span> users<br />
                    <span class="hljs-keyword">WHERE</span> created_at
                    <span class="hljs-keyword">BETWEEN</span> @<span
                      class="hljs-keyword"
                      >start</span
                    >
                    <span class="hljs-keyword">AND</span> @<span
                      class="hljs-keyword"
                      >end</span
                    ><br />
                    <span class="hljs-keyword">GROUP</span>
                    <span class="hljs-keyword">BY</span> x<br />
                    <span class="hljs-keyword">ORDER</span>
                    <span class="hljs-keyword">BY</span> x
                    <span class="hljs-keyword">ASC</span><br />
                  </div>
                </div>
              </div>

              <div class="mt-4">
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="store.helpModal.close()"
                >
                  Ok
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";
import { store } from "../store";
</script>
