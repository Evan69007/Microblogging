<template>
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <!-- Ajout du padding-top pour éviter que la navbar cache les posts -->

    <!-- Titre pour les posts -->
    <div class="flex justify-center">
      <h2 class="text-4xl text-gray-200 mb-8">Tous les Posts</h2>
    </div>
    <!-- Liste des posts centrée -->
    <div class="flex justify-center">
      <div class="w-full max-w-4xl space-y-6 overflow-y-auto">
        <!-- Affichage de tous les posts -->
        <div v-for="(post, index) in allPosts" :key="index">
          <PostCard :post="post" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import PostCard from "@/components/Posts/PostCard.vue"; // Importer le composant PostCard

// Simuler des posts de tous les utilisateurs
const allPosts = ref([
  {
    title: "Zoom sur une fonction PHP ou JS",
    content:
      '"array_filter()" en PHP, c’est la magie pour nettoyer des tableaux en un clin d’œil. Bonus : tu peux l’utiliser avec une fonction anonyme.',
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 2,
  },
  {
    title: "Question technique",
    content:
      '"Vous utilisez plutôt v-model ou des props/emit dans Vue 3 pour les formulaires ? Curieuse de vos habitudes ! #DevTalk"',
    date: "08/04/2025",
    author: "John",
    tags: ["astuces", "languages"],
    likes: 3,
    comments: 1,
  },
  {
    title: "Réflexion perso",
    content:
      "\"Aujourd'hui j'ai compris que git stash me sauve la vie quand je bricole avant un pull. L'outil magique du chaos\"",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 1,
  },
  {
    title: "Réflexion perso",
    content:
      "\"Aujourd'hui j'ai compris que git stash me sauve la vie quand je bricole avant un pull. L'outil magique du chaos\"",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 1,
  },
  {
    title: "Réflexion perso",
    content:
      "\"Aujourd'hui j'ai compris que git stash me sauve la vie quand je bricole avant un pull. L'outil magique du chaos\"",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 1,
  },
  {
    title: "Réflexion perso",
    content:
      "\"Aujourd'hui j'ai compris que git stash me sauve la vie quand je bricole avant un pull. L'outil magique du chaos\"",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 1,
  },
  {
    title: "Réflexion perso",
    content:
      "\"Aujourd'hui j'ai compris que git stash me sauve la vie quand je bricole avant un pull. L'outil magique du chaos\"",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 1,
  },
]);
</script>

<style scoped>
/* Styles spécifiques à la page d'accueil */
</style>
