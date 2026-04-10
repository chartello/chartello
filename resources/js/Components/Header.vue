<template>
  <header class="border-b bg-gray-900">
    <div
      class="container mx-auto flex flex-col items-end items-center justify-center px-6 pt-12 pb-12 md:flex-row"
    >
      <a
        :href="store.path"
        class="mb-6 flex items-center justify-center text-xl text-white md:mr-auto md:mb-0"
      >
        <Logo />
      </a>

      <slot />
    </div>
  </header>
</template>

<script setup>
import Logo from "./Logo.vue";
import { store } from "../store";
</script>
