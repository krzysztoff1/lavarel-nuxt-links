export default defineI18nConfig(() => ({
  legacy: false,
  locale: "en",
  messages: {
    en: {
      search: "Search",
      searchPlaceholder: "Search for articles...",
      genericError:
        "We're sorry, something went wrong. Please try again later.",
      source: "Source",
      loading: "Loading...",
      noArticles: "No articles found",
      back: "Back",
    },
    pl: {
      search: "Szukaj",
      searchPlaceholder: "Wyszukaj artykuły...",
      genericError:
        "Przepraszamy, coś poszło nie tak. Spróbuj ponownie później.",
      source: "Źródło",
      loading: "Ładowanie...",
      noArticles: "Nie znaleziono artykułów",
      back: "Wróć",
    },
  },
}));
