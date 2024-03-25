<script setup lang="ts">
import type { Article } from "~/types";

const { data: articles, status } = await useFetch<Article[]>(
  "http://127.0.0.1:8000/api/articles"
);
console.log(articles);
</script>

<template>
  <div class="view">
    <h1>Articles</h1>

    <p v-if="status === 'pending'">Loading...</p>
    <p v-if="status === 'error'">Error!</p>
    <ul v-if="status === 'success' && articles">
      <li v-for="article in articles" :key="article.guid">
        <a href=" {{ article.link }} ">{{ article.title }}</a>
      </li>
    </ul>
  </div>
</template>
