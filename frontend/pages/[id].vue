<script setup lang="ts">
import { parseHtml } from "~/lib/parse-html";
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

console.log(article);
</script>

<template>
  <Header />

  <h1 class="text-2xl font-bold px-4">{{ article?.title }}</h1>

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
    {{ parseHtml(article?.description) }}
  </div>

  <nuxt-link :to="`${article?.link}`" class="hover:underline text-sm px-4">{{
    $t("source")
  }}</nuxt-link>

  <Alert v-if="status === 'error'" type="error" :message="$t('genericError')" />
</template>
