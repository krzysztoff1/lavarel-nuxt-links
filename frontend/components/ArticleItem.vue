<script setup lang="ts">
import type { ArticleList } from "~/types";
import { formatDate } from "~/lib/format-date";

const { locale } = useI18n();

defineProps<{
  article: ArticleList[number];
}>();
</script>

<template>
  <li class="px-4 py-3 hover:bg-gray-100 radius-sm">
    <nuxt-link :to="`/${article.guid.split('=').at(-1)}`">
      <span class="text-md font-bold text-balance">{{ article.title }}</span>
      <p class="text-sm text-gray-500">
        {{ formatDate({ date: article.pubDate, locale }) }}
      </p>
    </nuxt-link>
  </li>
</template>
