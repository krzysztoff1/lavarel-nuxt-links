<script setup lang="ts">
import type { Article } from "~/types";

const route = useRoute();
const { data: article, status } = await useFetch<Article>(
  "http://127.0.0.1:8000/api/article/" + route.params.slug
);
</script>

<template>
  <div class="view">
    <h1>Articles</h1>

    <p v-if="status === 'pending'">Loading...</p>
    <p v-if="status === 'error'">Error!</p>

    <div v-if="status === 'success' && article">
      <h2>{{ article.title }}</h2>
      <p>{{ article.description }}</p>
    </div>
  </div>
</template>
