<script setup lang="ts">
const { locale, setLocale } = useI18n();
</script>

<template>
  <header class="flex justify-between items-center p-4 w-full">
    <nuxt-link to="/" class="text-xl font-bold">Blog</nuxt-link>
    <button
      @click="setLocale(locale === 'en' ? 'pl' : 'en')"
      class="p-2 hover:bg-gray-200"
    >
      {{ locale }}
    </button>
  </header>
</template>
