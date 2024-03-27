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
    <main class="bg-white flex flex-col items-start justify-start min-h-screen">
      <div class="max-w-2xl mx-auto px-4 w-full sm:px-6 lg:px-8 p-8 flex flex-col space-y-6">
        <NuxtPage />
      </div>
    </main>
  </NuxtLayout>
</template>
