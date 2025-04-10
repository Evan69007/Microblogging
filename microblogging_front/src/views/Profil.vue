<template>
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <!-- Bouton "Modifier Profil" -->
    <div class="absolute top-32 right-16 z-10">
      <button
        @click="editProfile"
        class="bg-orange-600 text-white py-2 px-6 rounded-md hover:bg-orange-700 transition"
      >
        Modifier Profil
      </button>
    </div>

    <!-- Conteneur en flex pour la biographie et les posts -->
    <div class="flex gap-16 pt-32 px-16 items-stretch">
      <!-- items-stretch pour égaliser la hauteur des deux sections -->
      <!-- Section Biographie (à gauche) -->
      <div
        class="flex-1 text-center bg-gray-900 p-6 rounded-xl shadow-lg max-h-[700px] sticky top-32"
      >
        <h2 class="text-5xl text-gray-400 mb-4">Biographie</h2>
        <!-- Prénom de l'utilisateur en jaune, gras et plus grand -->
        <p class="text-7xl text-yellow-300 font-bold">{{ userName }}</p>
        <!-- Description de l'utilisateur -->
        <p class="text-2xl text-gray-300 mt-4">{{ biography }}</p>
      </div>

      <!-- Section Posts de l'utilisateur (à droite) -->
      <div class="flex-1 max-w-5xl mx-auto pt-1 space-y-8 px-2 overflow-y-auto">
        <!-- Affichage de tous les posts de l'utilisateur -->
        <div v-for="(post, index) in userPosts" :key="index">
          <PostCard :post="post" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import PostCard from "@/components/Posts/PostCard.vue"; // Importer le composant PostCard

// Simuler des données pour l'utilisateur
const userName = ref("Laura"); // Prénom de l'utilisateur
const biography = ref(
  "Développeuse full stack passionnée par le clean code et le partage de connaissances, je transforme les lignes de code en solutions concrètes. Curieuse et toujours en veille, j’aime expérimenter, documenter et transmettre mes découvertes."
);

// Simuler des posts de l'utilisateur
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
    author: "Laura",
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

// Filtrer les posts de l'utilisateur (ici tous les posts sont de l'utilisateur "Laura")
const userPosts = ref(
  allPosts.value.filter((post) => post.author === userName.value)
);

// Fonction pour éditer le profil
function editProfile() {
  console.log("Modification du profil...");
}
</script>

<style scoped>
/* Appliquer un espacement vertical entre chaque post */
.flex-1 > * + * {
  margin-top: 4rem; /* Augmenter l'espacement entre les posts */
}
</style>
