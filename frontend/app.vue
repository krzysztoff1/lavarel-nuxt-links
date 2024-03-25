<script setup lang="ts">
useSeoMeta({
  titleTemplate: "Blog",
  description: "Simple blog made with Nuxt.js and Laravel",
});
useHead({
  link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
});
</script>

<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>
