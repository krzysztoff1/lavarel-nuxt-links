<script setup lang="ts">
import type { Article } from "~/types";

const config = useRuntimeConfig();
const route = useRoute();

const { data: article, status } = await useFetch<Article>(
  config.public.backendUrl + "/api/article/" + route.params.id
);

</script>

<template>
  <h1 class="text-3xl font-bold">{{ article?.title }}</h1>

  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
    <ul class="flex flex-row space-x-2">
      <li v-for="category in article?.category" :key="category" class="text-sm">
        #{{ category }}
      </li>
    </ul>

    <nuxt-link :to="`${article?.link}`" class="hover:underline text-sm">Source</nuxt-link>
  </div>

  <div v-if="status === 'success' && article">
    <p>{{ article.description }}</p>
  </div>

  <Alert v-if="status === 'error'" type="error" message="We're sorry, something went wrong. Please try again later." />
</template>
