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
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import PostCard from "@/components/Posts/PostCard.vue"; // Importer le composant PostCard
import api from "@/services/api.js";

// Récupérer les paramètres de la route pour obtenir l'id du post
const route = useRoute();
const router = useRouter();
const postId = route.params.id;
const postToEdit = ref({
  titre: "",
  description: "",
  hashtags: "",
});
const isLoading = ref(false);

// Données simulées pour les posts

// Trouver le post à modifier en fonction de l'id passé dans l'URL
onMounted(async () => {
  try {
    isLoading.value = true;
    const post = await api.getPost(postId);
    if (post.hashtags) {
      post.hashtags = post.hashtags.join(", ");
    }

    postToEdit.value = post;
    isLoading.value = false;
  } catch (error) {
    console.error(error);
  }
});

async function submitForm() {
  postToEdit.value.hashtags = postToEdit.value.hashtags.split(", ");
  await api.updatePost(postId, postToEdit.value);
  router.push("/profil"); // Retour vers Profil.vue après modification
}

// function updatePost(updatedPost) {
//   postToEdit.value = updatedPost;
// }
</script>

<style scoped>
/* Styles spécifiques à ModifPost.vue */
</style>
