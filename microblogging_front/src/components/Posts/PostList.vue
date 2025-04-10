<template>
  <!-- Conteneur centré, largeur max 5xl, avec marge intérieure et espacement vertical -->
  <div class="max-w-5xl mx-auto pt-28 space-y-14 px-8">
    <!-- Boucle sur la liste des posts triés, et affiche chaque post avec le composant PostCard -->
    <PostCard v-for="post in sortedPosts" :key="post.id" :post="post" />
  </div>
</template>

<script setup>
import PostCard from "./PostCard.vue"; // Import du composant qui affiche un post sous forme de carte
import { computed } from "vue"; // Pour créer une propriété calculée réactive

// Déclaration des props attendues depuis le parent
const props = defineProps({
  posts: {
    type: Array,
    required: true,
  },
});

// Tri des posts du plus récent au plus ancien
// Hypothèse : la date est au format "dd/mm/yyyy"
const sortedPosts = computed(() => {
  return [...props.posts].sort((a, b) => {
    // Extraction des jours/mois/années et conversion en objets Date
    const [d1, m1, y1] = a.date.split("/").map(Number);
    const [d2, m2, y2] = b.date.split("/").map(Number);

    // Tri décroissant : post plus récent en premier
    return new Date(y2, m2 - 1, d2) - new Date(y1, m1 - 1, d1);
  });
});
</script>
