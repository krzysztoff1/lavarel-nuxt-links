<script setup lang="ts">
import type { ArticleList } from "~/types";

const router = useRouter();

const { data: articles, status } = await useFetch<ArticleList>(
  "http://127.0.0.1:8000/api/articles"
);
</script>

<template>
  <div class="view">
    <h1>Articles</h1>

    <p v-if="status === 'pending'">Loading...</p>
    <p v-if="status === 'error'">Error!</p>
    <ul v-if="status === 'success' && articles">
      <li v-for="article in articles" :key="article.guid">
        <nuxt-link :to="`/${article.link.slice(0, -1).split('/').at(-1)}`">
          {{ article.title }}
        </nuxt-link>
      </li>
    </ul>
  </div>
</template>
