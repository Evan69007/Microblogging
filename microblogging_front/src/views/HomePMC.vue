<template>
  <div class="min-h-screen bg-gray-900">
    <div class="container mx-auto px-4 py-8 mt-32">
      <h2 class="text-white text-3xl font-bold mb-8 text-center">
        Tous les Posts
      </h2>
      <div class="flex mt-16 justify-center">
        <PostList :posts="posts" />
      </div>
    </div>
  </div>
</template>

<script setup>
// 📦 Import des fonctions de Vue
import { ref, onMounted } from "vue";

// 📁 Import du composant d'affichage des posts
import PostList from "@/components/Posts/PostList.vue";

// 🌐 Import du service API centralisé
import api from "@/services/api.js";

// 🗃️ Déclaration d’une variable réactive pour stocker les posts récupérés
const posts = ref([]);

// 🔄 Fonction pour charger les posts depuis l'API
const fetchPosts = async () => {
  const response = await api.getPosts(); // Appel à l'API pour récupérer les posts
  console.log("Données chargées :", response); // Debug dans la console
  posts.value = response; // Mise à jour de la variable réactive
};

// ⏱️ Quand le composant est monté, on déclenche la récupération des données
onMounted(() => {
  fetchPosts();
});
</script>

<style scoped>
/* Styles spécifiques à la page d'accueil */
</style>

<!-- Ce composant a pour but de :
    Charger automatiquement les posts dès l'affichage de la page
    Stocker ces données dans une variable réactive (posts)
    Les afficher ensuite via le composant <PostList /> -->
