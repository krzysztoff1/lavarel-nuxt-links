<script setup lang="ts">
import type { ArticleList } from "~/types";

defineProps<{
  article: ArticleList[number];
}>();
</script>

<template>
  <li class="px-4 py-3 hover:bg-gray-100 radius-sm">
    <nuxt-link :to="`/${article.guid.split('=').at(-1)}`">
      <span class="text-md font-bold text-balance">{{ article.title }}</span>
      <p>{{ article.pubDate.split("+")[0] }}</p>
    </nuxt-link>
  </li>
</template>
