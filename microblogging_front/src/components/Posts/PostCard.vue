<template>
  <div class="bg-gray-900 max-w-256 p-6 rounded-xl shadow-lg">
    <!-- Post Header -->
    <div class="flex justify-center items-start">
      <h3 class="text-xl font-semibold text-orange-400">{{ post.titre }}</h3>
      <div class="text-sm text-gray-500">{{ post.date }}</div>
    </div>

    <!-- Post Content -->
    <p class="text-center text-lg text-gray-300 mt-4">{{ post.description }}</p>

    <!-- Post Author -->
    <div class="flex items-center space-x-2 mt-4">
      <span class="text-white">Publié par</span>
      <span class="text-yellow-300">{{ post.user.name }}</span>
    </div>

    <!-- Post Footer: Tags, Likes, Comments -->
    <div class="flex items-center justify-between mt-4">
      <div class="flex space-x-3">
        <span
          v-for="tag in post.hashtags"
          :key="tag"
          class="bg-teal-800 text-sm text-white font-bold pl-1 pr-1 pb-1 tags"
          >{{ tag }}</span
        >
      </div>
      <div class="flex space-x-3">
        <span class="flex items-center">
          <button @click="toggleLike(post.id)">
            {{ isLiked ? "❤️" : "🤍" }}
          </button>
        </span>
        <!-- <span class="flex items-center">
          <comment-icon class="text-blue-500" /> {{ post.comments }}
        </span> -->
      </div>
    </div>

    <!-- Buttons to Edit and Delete the Post, only visible to the author -->
    <div v-if="post.user.name === currentUser" class="flex justify-end">
      <button
        @click="editPost(post.id)"
        class="bg-green-800 text-white py-1 px-4 rounded-md hover:bg-blue-600 mr-4"
      >
        Modifier
      </button>
      <button
        @click="deletePost(post.id)"
        class="bg-red-500 text-white py-1 px-4 rounded-md hover:bg-red-600"
      >
        Supprimer
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import api from "@/services/api.js";

// Propriétés passées par le parent
defineProps({
  post: Object,
});
const router = useRouter();
const currentUser = ref("");
const isLiked = ref(false);
// Fonction pour récupérer l'utilisateur connecté (à partir de localStorage par exemple)
onMounted(() => {
  currentUser.value = sessionStorage.getItem("userName"); // Remplace par la méthode que tu utilises pour gérer l'utilisateur connecté
});

// Événements pour modifier et supprimer un post
const emit = defineEmits(["editPost", "deletePost"]);

// Fonction pour appeler l'événement de modification
function editPost(id) {
  router.push(`/modif-post/${id}`);
}

// Fonction pour appeler l'événement de suppression
async function deletePost(id) {
  try {
    const response = await api.deletePost(id);
    if (response === "Erreur") {
      console.error(response);
    } else {
      router.go(0);
    }
  } catch (error) {
    console.error("Error: ", error);
  }
}

async function toggleLike(post_id) {
  if (isLiked.value) {
    isLiked.value = false;
    const response = await fetch(`http://localhost:8000/api/likes/${post_id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    });
  } else {
    isLiked.value = true;
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));
    const response = await fetch("http://localhost:8000/api/user", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `${access_token.token_type} ${access_token.access_token}`, // Remplacer par le token d'authentification de l'utilisateur
      },
    });
    const data = await response.json();
    const like = await fetch("http://localhost:8000/api/likes", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({
        user_id: data.id,
        post_id: post_id,
      }),
    });
  }
}
</script>

<style scoped>
.tags {
  border-radius: 10px;
}
</style>
