<template>
  <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
    <!-- Post Header -->
    <div class="flex justify-between items-start">
      <h3 class="text-xl font-semibold text-orange-400">{{ post.title }}</h3>
      <div class="text-sm text-gray-500">{{ post.date }}</div>
    </div>

    <!-- Post Content -->
    <p class="text-lg text-gray-300 mt-4">{{ post.content }}</p>

    <!-- Post Author -->
    <div class="flex items-center space-x-2 mt-4">
      <span class="text-gray-400">Publié par</span>
      <span class="text-yellow-300">{{ post.author }}</span>
    </div>

    <!-- Post Footer: Tags, Likes, Comments -->
    <div class="flex items-center justify-between mt-4">
      <div class="flex space-x-3">
        <span v-for="tag in post.tags" :key="tag" class="text-sm text-teal-400"
          >#{{ tag }}</span
        >
      </div>
      <div class="flex space-x-3">
        <span class="flex items-center">
          <heart-icon class="text-red-500" /> {{ post.likes }}
        </span>
        <span class="flex items-center">
          <comment-icon class="text-blue-500" /> {{ post.comments }}
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  post: Object,
});
</script>

<style scoped>
/* Styles spécifiques à la carte de post */
</style>
