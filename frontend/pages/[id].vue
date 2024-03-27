<script setup lang="ts">
import type { Article } from "~/types";

const config = useRuntimeConfig();
const route = useRoute();
const { locale } = useI18n();

const { data: article, status } = await useFetch<Article>(
  config.public.backendUrl + "/api/article/" + route.params.id,
  {
    query: { lang: locale },
  }
);
</script>

<template>
  <Header :title="article?.title" />

  <nuxt-link to="/" class="text-sm hover:underline px-4"
    >← {{ $t("back") }}</nuxt-link
  >

  <div
    class="flex flex-col sm:flex-row sm:justify-between sm:items-center px-4"
  >
    <ul class="flex flex-row space-x-2">
      <li v-for="category in article?.category" :key="category" class="text-sm">
        #{{ category }}
      </li>
    </ul>
  </div>

  <div v-if="status === 'success' && article" class="px-4">
    <p v-html="article.description"></p>
  </div>

  <nuxt-link :to="`${article?.link}`" class="hover:underline text-sm">{{
    $t("source")
  }}</nuxt-link>

  <Alert v-if="status === 'error'" type="error" :message="$t('genericError')" />
</template>
