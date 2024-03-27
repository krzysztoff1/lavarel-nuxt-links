<script setup lang="ts">
defineProps<{
  type: "neutral" | "error";
  message: string;
}>();
</script>

<template>
  <div v-if="type === 'error'" class="p-4 bg-red-100/50 radius-sm text-red-800">
    <p>
      {{ message }}
    </p>
  </div>

  <div
    v-if="type === 'neutral'"
    class="p-4 bg-gray-100/50 radius-sm text-gray-800"
  >
    <p>
      {{ message }}
    </p>
  </div>
</template>
