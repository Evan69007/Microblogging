<template>
  <!-- Carte du post avec style dynamique basé sur la couleur du post -->
  <div
    class="p-4 bg-white text-black rounded-xl shadow-lg hover:shadow-xl transition-all duration-300"
    :class="post.couleur"
  >
    <!-- Titre du post : en majuscules, gras, taille xl -->
    <h3 class="text-xl font-bold uppercase mb-2">{{ post.titre }}</h3>

    <!-- Contenu du post : texte standard, gris foncé -->
    <p class="text-l text-gray-800 mb-4">{{ post.contenu }}</p>

    <!-- Informations sur l’auteur et la date de publication -->
    <div class="flex justify-between items-center text-xs text-gray-600 mb-2">
      <span>Par {{ post.auteur }}</span>
      <span>{{ post.date }}</span>
    </div>

    <!-- Liste des tags : bouclés avec v-for, style badge -->
    <div class="flex flex-wrap gap-1 mb-3">
      <span
        v-for="tag in post.tags"
        :key="tag"
        class="text-xs bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full"
      >
        {{ tag }}
      </span>
    </div>

    <!-- Affichage des likes et commentaires avec des icônes -->
    <div class="flex justify-between items-center text-sm font-medium">
      <span class="text-pink-600">❤️ {{ post.likes }}</span>
      <span class="text-blue-600">💬 {{ post.comments }}</span>
    </div>
  </div>
</template>

<script setup>
// Déclaration de la prop "post" attendue depuis le composant parent
defineProps({
  post: Object,
});
</script>

<style scoped>
/* Aucun style spécifique ici pour le moment */
</style>
