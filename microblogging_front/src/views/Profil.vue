<template>
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <!-- Bouton "Modifier Profil" -->
    <div class="absolute top-32 right-16 z-10">
      <button
        @click="editProfile"
        class="bg-green-800 text-white py-2 px-6 rounded-md hover:bg-orange-700 transition"
      >
        Modifier Profil
      </button>
    </div>

    <!-- Conteneur en flex pour la biographie et les posts -->
    <div class="flex gap-16 pt-32 px-16 items-stretch">
      <!-- Section Biographie (à gauche) -->
      <div
        class="flex-1 text-center bg-gray-900 p-6 rounded-xl shadow-lg max-h-[700px] sticky top-32"
      >
        <h2 class="text-5xl text-gray-400 mb-4">Biographie</h2>
        <p class="text-7xl text-yellow-300 font-bold">{{ userName }}</p>
        <p class="text-2xl text-gray-300 mt-4">{{ biography }}</p>
      </div>

      <!-- Section Posts de l'utilisateur (à droite) -->
      <div class="flex-1 max-w-5xl mx-auto pt-1 space-y-8 px-2 overflow-y-auto">
        <!-- Affichage de tous les posts de l'utilisateur -->
        <div v-for="(post, index) in userPosts" :key="index">
          <PostCard
            :post="post"
            @editPost="editPost"
            @deletePost="deletePost"
          />
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
); // Biographie
const allPosts = ref([
  // Liste de posts simulée
  {
    title: "Zoom sur une fonction PHP ou JS",
    content: "Description...",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 2,
  },
  {
    title: "Zoom sur une fonction PHP ou JS",
    content: "Description...",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 2,
  },
  {
    title: "Zoom sur une fonction PHP ou JS",
    content: "Description...",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 2,
  },
  {
    title: "Zoom sur une fonction PHP ou JS",
    content: "Description...",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 2,
  },
  {
    title: "Zoom sur une fonction PHP ou JS",
    content: "Description...",
    date: "08/04/2025",
    author: "Laura",
    tags: ["astuces", "languages"],
    likes: 4,
    comments: 2,
  },
]);

// Filtrer les posts de l'utilisateur
const userPosts = ref(
  allPosts.value.filter((post) => post.author === userName.value)
);

// Fonction pour éditer un post
function editPost(post) {
  console.log("Modification du post:", post);
  // Ajoute la logique de modification ici (par exemple, ouvrir un modal ou rediriger vers un formulaire)
}

// Fonction pour supprimer un post
function deletePost(post) {
  console.log("Suppression du post:", post);
  // Ajoute la logique pour supprimer le post (par exemple, le retirer de la liste)
  userPosts.value = userPosts.value.filter((p) => p !== post);
}
</script>

<style scoped>
/* Styles spécifiques à Profil.vue */
</style>
