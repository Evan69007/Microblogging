<template>
  <div class="space-y-6">
    <div
      v-if="posts.length === 0"
      class="text-center text-gray-400 bg-gray-800 rounded-md p-6"
    >
      Aucun post à afficher
    </div>
    <div
      v-else
      v-for="post in sortedPosts"
      :key="post.id"
      class="bg-gray-800 rounded-md shadow p-4 max-w-256 p-4"
    >
      <PostCard
        :post="post"
        @delete="$emit('delete-post', post.id)"
        @edit="$emit('edit-post', post.id, $event)"
      />
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue"; // Pour calculer dynamiquement les posts triés
import PostCard from "./PostCard.vue"; // Composant enfant affichant un post individuel

// 🔁 Déclaration des props : une liste de posts passée par le parent
const props = defineProps({
  posts: {
    type: Array,
    default: () => [], // Valeur par défaut : tableau vide
  },
});

// 🎯 Déclaration des événements émis par le composant (redirigés vers le parent)
defineEmits(["delete-post", "edit-post"]);

// 🔽 Calcul des posts triés du plus récent au plus ancien (ID décroissant)
const sortedPosts = computed(() => {
  return [...props.posts].sort((a, b) => b.id - a.id);
});
</script>

<!-- Ce script est utilisé pour un composant de type PostList.vue dont le rôle est :
    ✅ Recevoir une liste de posts depuis un composant parent
    ✅ Trier ces posts pour afficher les plus récents en premier
    ✅ Émettre des événements de suppression ou modification vers le parent via @delete-post et @edit-post
    ✅ Rendre chaque post à l’aide du composant PostCard.vue -->
