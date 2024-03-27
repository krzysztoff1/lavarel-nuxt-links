<script setup lang="ts">
const { locale, setLocale } = useI18n();
</script>

<template>
  <header class="flex justify-between items-center py-4 w-full">
    <span class="text-xl font-bold">Blog</span>
    <button
      @click="setLocale(locale === 'en' ? 'pl' : 'en')"
      class="p-2 hover:bg-gray-200"
    >
      {{ locale }}
    </button>
  </header>
</template>
