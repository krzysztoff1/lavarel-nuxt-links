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
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
});
