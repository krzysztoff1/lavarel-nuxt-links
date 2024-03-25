<script setup lang="ts">
import type { ArticleList } from "~/types";

const config = useRuntimeConfig();
const articleListApiUrl = config.public.backendUrl + "/api/articles";

const { data: articles, status } =
  await useFetch<ArticleList>(articleListApiUrl);

const articleList = ref<ArticleList | null>(null);
const search = ref("");

onMounted(async () => {
  articleList.value = await fetch(articleListApiUrl).then((res) => res.json());
});

watch(search, (searchTerm) => {
  if (searchTerm && articleList.value) {
    articles.value = articleList.value.filter(
      (article) =>
        article.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
        article.category.some((category) =>
          category.toLowerCase().includes(searchTerm.toLowerCase())
        )
    );

    return;
  }

  articles.value = articleList.value;
});
</script>

<template>
  <div class="view">
    <h1>Articles</h1>

    <form @submit.prevent>
      <input type="text" v-model="search" placeholder="Search articles" />
      <button type="submit">Search</button>
    </form>
    <p v-if="status === 'pending'">Loading...</p>
    <p v-if="status === 'error'">Error!</p>
    <ul v-if="status === 'success' && articles?.length">
      <li v-for="article in articles" :key="article.guid">
        <nuxt-link :to="`/${article.link.slice(0, -1).split('/').at(-1)}`">
          {{ article.title }} {{ article.category.join(", ") }}
        </nuxt-link>
      </li>
    </ul>
    <div v-if="status === 'success' && !articles?.length">
      No articles found {{ search ? `for "${search}"` : "" }}
    </div>
  </div>
</template>
