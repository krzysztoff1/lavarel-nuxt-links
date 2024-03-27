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
  <h1 class="text-3xl font-bold">Linkhouse Blog</h1>

  <form @submit.prevent>
    <input type="text" v-model="search" placeholder="Search articles" />
    <button type="submit">Search</button>
  </form>

  <ul v-if="status === 'success' && articles?.length" class="flex flex-col space-y-2">
    <ArticleItem v-for="article in articles" :key="article.guid" :article="article" />
  </ul>

  <Alert v-if="status === 'pending'" type="neutral" message="Loading..." />

  <Alert v-if="status === 'error'" type="error" message="We're sorry, something went wrong. Please try again later." />

  <Alert v-if="status === 'success' && !articles?.length" type="neutral" message="No articles found." />
</template>
