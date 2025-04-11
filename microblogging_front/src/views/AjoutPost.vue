<template>
  <div class="bg-gray-800 text-white min-h-screen mt-24 pt-32 pb-8">
    <div class="flex justify-center items-center">
      <div class="w-full max-w-4xl bg-gray-900 p-6 rounded-xl shadow-lg">
        <h2 class="text-3xl text-gray-400 mb-4">Ajouter un Post</h2>

        <!-- Formulaire de création de post -->
        <form @submit.prevent="submitPost">
          <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-300"
              >Titre</label
            >
            <input
              id="title"
              v-model="newPost.title"
              type="text"
              placeholder="Titre de votre post"
              class="w-full p-3 border border-gray-300 rounded-md mt-2"
              required
            />
          </div>

          <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-300"
              >Contenu</label
            >
            <textarea
              id="content"
              v-model="newPost.content"
              placeholder="Écrivez votre post ici"
              class="w-full p-3 border border-gray-300 rounded-md mt-2"
              rows="5"
              required
            ></textarea>
          </div>

          <!-- Utilisation du composant TagChecklist pour sélectionner des tags -->
          <TagChecklist ref="tagChecklist" />

          <div>
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Ajouter le Post
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import TagChecklist from "@/components/Posts/TagChecklist.vue"; // Assure-toi que le fichier existe ici

// Données du post
const newPost = ref({
  title: "",
  content: "",
  tags: [],
});

// Fonction pour soumettre le post
function submitPost() {
  // Récupérer les tags depuis TagChecklist
  newPost.value.tags = $refs.tagChecklist.selectedTags;

  // Afficher dans la console ou envoyer l'objet post à une API
  console.log("Nouveau post ajouté :", newPost.value);

  // Réinitialiser le formulaire après soumission
  newPost.value = { title: "", content: "", tags: [] };
}
</script>
