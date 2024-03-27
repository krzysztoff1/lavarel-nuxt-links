<script setup lang="ts">
import type { ArticleList } from "~/types";

const config = useRuntimeConfig();
const articleListApiUrl = config.public.backendUrl + "/api/articles";
const { locale } = useI18n();

const { data: articles, status } = await useFetch<ArticleList>(
  articleListApiUrl,
  { query: { lang: locale } }
);

const filteredArticles = ref<ArticleList>(articles.value);
const search = ref("");

watch(articles, (newArticles) => {
  filteredArticles.value = newArticles;
});

const handleSearch = (searchTerm: string) => {
  if (!searchTerm) {
    filteredArticles.value = articles.value;
    return;
  }

  filteredArticles.value = articles.value.filter(
    (article) =>
      article.title.toLowerCase().includes(search.value.toLowerCase()) ||
      article.category.some((category) =>
        category.toLowerCase().includes(search.value.toLowerCase())
      )
  );
};

watch(search, (term) => handleSearch(term));
</script>

<template>
  <Header />

  <form @submit.prevent @submit="handleSearch(search)" class="flex space-x-2">
    <input
      type="text"
      v-model="search"
      :placeholder="$t('searchPlaceholder')"
      class="border p-1 outline-gray-500 focus:bg-gray-100"
    />
    <button type="submit" class="bg-gray-200 p-1">{{ $t("search") }}</button>
  </form>

  <ul
    v-if="status === 'success' && filteredArticles"
    class="flex flex-col space-y-2"
  >
    <ArticleItem
      v-for="article in filteredArticles"
      :key="article.guid"
      :article="article"
    />
  </ul>

  <Alert v-if="status === 'pending'" type="neutral" :message="$t('loading')" />

  <Alert v-if="status === 'error'" type="error" :message="$t('genericError')" />

  <Alert
    v-if="status === 'success' && !filteredArticles.length"
    type="neutral"
    :message="$t('noArticles')"
  />
</template>
