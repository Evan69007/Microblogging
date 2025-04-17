<template>
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <div class="flex justify-center">
      <div class="w-full max-w-4xl bg-gray-900 p-6 rounded-xl shadow-lg">
        <h2 class="text-3xl text-gray-400 mb-4">Modifier le Post</h2>

        <!-- Formulaire de modification de post -->
        <form v-if="!isLoading" @submit.prevent="submitForm">
          <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-300"
              >Titre</label
            >
            <input
              id="title"
              v-model="postToEdit.titre"
              type="text"
              placeholder="Titre du post"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
              required
            />
          </div>

          <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-300"
              >Contenu</label
            >
            <textarea
              id="content"
              v-model="postToEdit.description"
              placeholder="Écrivez votre post ici"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
              rows="5"
              required
            ></textarea>
          </div>

          <div class="mb-6">
            <label for="tags" class="block text-sm font-medium text-gray-300"
              >Tags</label
            >
            <input
              id="tags"
              v-model="postToEdit.hashtags"
              type="text"
              placeholder="Séparez les tags par une virgule"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
            />
          </div>

          <div>
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Sauvegarder les modifications
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
// 🔧 Imports nécessaires de Vue
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

// 🧩 Composant pour afficher un post (utile pour l’édition visuelle si besoin)
import PostCard from "@/components/Posts/PostCard.vue";

// 🌐 API centralisée pour les appels backend
import api from "@/services/api.js";

// 📍 Récupération de l'ID du post à modifier depuis l'URL
const route = useRoute();
const router = useRouter();
const postId = route.params.id;

// ✏️ Données du post à modifier
const postToEdit = ref({
  titre: "",
  description: "",
  hashtags: "",
});

// 🔄 Indicateur de chargement
const isLoading = ref(false);

// ⏱️ Dès que le composant est monté, on charge les données du post à modifier
onMounted(async () => {
  try {
    isLoading.value = true;

    // Récupération du post via son ID
    const post = await api.getPost(postId);

    // Transformation du tableau hashtags en chaîne pour l’affichage dans un input
    if (post.hashtags) {
      post.hashtags = post.hashtags.join(", ");
    }

    // Mise à jour de l’état local
    postToEdit.value = post;
    isLoading.value = false;
  } catch (error) {
    console.error("Erreur lors du chargement du post :", error);
  }
});

// ✅ Fonction pour soumettre les modifications
async function submitForm() {
  // Transformation des hashtags string -> tableau
  postToEdit.value.hashtags = postToEdit.value.hashtags
    .split(",")
    .map((tag) => tag.trim());

  // Mise à jour du post via l’API
  await api.updatePost(postId, postToEdit.value);

  // Redirection vers la page profil après modification
  router.push("/profil");
}
</script>

<style scoped>
/* Styles spécifiques à ModifPost.vue */
</style>
<!-- Ce script permet à un utilisateur :
    De charger un post existant à partir de son ID
    D’éditer les champs du post (titre, description, hashtags)
    De soumettre la mise à jour via l’API
    De revenir au profil une fois terminé -->
