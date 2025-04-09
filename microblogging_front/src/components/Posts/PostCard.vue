<template>
  <div
    class="p-4 bg-white text-black rounded-xl shadow-lg hover:shadow-xl transition-all duration-300"
    :class="post.couleur"
  >
    <!-- Titre du post -->
    <h3 class="text-xl font-bold uppercase mb-2">{{ post.titre }}</h3>

    <!-- Contenu du post -->
    <p class="text-l text-gray-800 mb-4">{{ post.contenu }}</p>

    <!-- Infos utilisateur -->
    <div class="flex justify-between items-center text-xs text-gray-600 mb-2">
      <span>Par {{ post.auteur }}</span>
      <span>{{ post.date }}</span>
    </div>

    <!-- Tags -->
    <div class="flex flex-wrap gap-1 mb-3">
      <span
        v-for="tag in post.tags"
        :key="tag"
        class="text-xs bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full"
      >
        {{ tag }}
      </span>
    </div>

    <!-- Likes et commentaires -->
    <div class="flex justify-between items-center text-sm font-medium">
      <span class="text-pink-600">❤️ {{ post.likes }}</span>
      <span class="text-blue-600">💬 {{ post.comments }}</span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  post: Object,
});
</script>

<style scoped></style>
