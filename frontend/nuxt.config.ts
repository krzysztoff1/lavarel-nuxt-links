// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: {
    enabled: true,
  },
  css: ["~/assets/css/main.css"],
  runtimeConfig: {
    public: {
      backendUrl: process.env.BACKEND_URL,
    },
  },
  modules: ["@nuxtjs/i18n"],
  i18n: {
    vueI18n: "./i18n.config.ts", // if you are using custom path, default
  },
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
});
