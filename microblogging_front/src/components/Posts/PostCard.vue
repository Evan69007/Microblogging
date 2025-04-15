<template>
  <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
    <!-- Post Header -->
    <div class="flex justify-between items-start">
      <h3 class="text-xl font-semibold text-orange-400">{{ post.titre }}</h3>
      <div class="text-sm text-gray-500">{{ post.date }}</div>
    </div>

    <!-- Post Content -->
    <p class="text-lg text-gray-300 mt-4">{{ post.description }}</p>

    <!-- Post Author -->
    <div class="flex items-center space-x-2 mt-4">
      <span class="text-gray-400">Publié par</span>
      <span class="text-yellow-300">{{ post.user.name }}</span>
    </div>

    <!-- Post Footer: Tags, Likes, Comments -->
    <div class="flex items-center justify-between mt-4">
      <div class="flex space-x-3">
        <span
          v-for="tag in post.hashtags"
          :key="tag"
          class="text-sm text-teal-400"
          >{{ tag }}</span
        >
      </div>
      <div class="flex space-x-3">
        <span class="flex items-center">
          <heart-icon class="text-red-500" /> {{ post.likes }}
        </span>
        <span class="flex items-center">
          <comment-icon class="text-blue-500" /> {{ post.comments }}
        </span>
      </div>
    </div>

    <!-- Buttons to Edit and Delete the Post, only visible to the author -->
    <div
      v-if="post.user.name === currentUser"
      class="mt-4 flex justify-between"
    >
      <button
        @click="editPost"
        class="bg-green-800 text-white py-1 px-4 rounded-md hover:bg-blue-600"
      >
        Modifier
      </button>
      <button
        @click="deletePost"
        class="bg-red-500 text-white py-1 px-4 rounded-md hover:bg-red-600"
      >
        Supprimer
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

// Propriétés passées par le parent
defineProps({
  post: Object,
});
const currentUser = ref("");
// Fonction pour récupérer l'utilisateur connecté (à partir de localStorage par exemple)
onMounted(() => {
  currentUser.value = sessionStorage.getItem("userName"); // Remplace par la méthode que tu utilises pour gérer l'utilisateur connecté
});

// Événements pour modifier et supprimer un post
const emit = defineEmits(["editPost", "deletePost"]);

// Fonction pour appeler l'événement de modification
function editPost() {
  emit("editPost", post);
}

// Fonction pour appeler l'événement de suppression
function deletePost() {
  emit("deletePost", post);
}
</script>

<style scoped>
/* Styles spécifiques à la carte de post */
</style>
