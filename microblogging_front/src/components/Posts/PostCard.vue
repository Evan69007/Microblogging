<template>
  <div class="bg-gray-900 max-w-256 p-6 rounded-xl shadow-lg">
    <!-- Post Header -->
    <div class="flex justify-center items-start">
      <h3 class="text-2xl font-semibold text-orange-400">{{ post.titre }}</h3>
      <div class="text-sm text-gray-500">{{ post.date }}</div>
    </div>

    <!-- Post Content -->
    <p class="text-center text-lg text-gray-300 mt-8">{{ post.description }}</p>

    <!-- Post Author -->
    <div class="flex items-center space-x-2 mt-2">
      <span class="text-white">Publié par</span>
      <span class="text-yellow-300">{{ post.user.name }}</span>
    </div>

    <!-- Post Footer: Tags, Likes, Comments -->
    <div class="flex items-center justify-between mt-2">
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
    <div v-if="post.user.name === currentUser" class="flex justify-end mt-2">
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
import api from "@/services/api.js"; // 📦 Service personnalisé pour gérer les appels API (deletePost ici)

// Props reçue du composant parent : un objet post
defineProps({
  post: Object,
});

const router = useRouter(); // Pour les redirections
const currentUser = ref(""); // Stocke le nom de l'utilisateur connecté
const isLiked = ref(false); // État du like sur ce post (local)

// 🔍 Au montage du composant, on récupère l'utilisateur courant (depuis la session)
onMounted(() => {
  currentUser.value = sessionStorage.getItem("userName");
});

// 📤 On déclare les événements qui peuvent être émis au parent
const emit = defineEmits(["editPost", "deletePost"]);

// ✏️ Redirection vers la page de modification du post
function editPost(id) {
  router.push(`/modif-post/${id}`);
}

// 🗑️ Suppression d'un post via ton fichier api.js, puis rafraîchissement
async function deletePost(id) {
  try {
    const response = await api.deletePost(id); // Appel au service d'API
    if (response === "Erreur") {
      console.error(response); // Affiche une erreur si le backend renvoie "Erreur"
    } else {
      router.go(0); // Recharge la page (peut être remplacé plus tard par mise à jour dynamique)
    }
  } catch (error) {
    console.error("Error: ", error);
  }
}

// ❤️ Fonction de toggle (like/dislike)
async function toggleLike(post_id) {
  if (isLiked.value) {
    // Si déjà liké, on le retire
    isLiked.value = false;
    const response = await fetch(`http://localhost:8000/api/likes/${post_id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    });
  } else {
    // Si pas encore liké, on ajoute un like
    isLiked.value = true;

    const access_token = JSON.parse(sessionStorage.getItem("access_token"));

    // On récupère les infos utilisateur via le token
    const response = await fetch("http://localhost:8000/api/user", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
      },
    });

    const data = await response.json();

    // Puis on envoie le like
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
<!-- Ce script est la logique d’un composant de post individuel, avec plusieurs fonctions clés :
    ✅ Permet à l’utilisateur connecté de liker ou déliker un post
    ✅ Permet de modifier ou supprimer un post via des actions (souvent affichées si l’auteur est l’utilisateur courant)
    ✅ Gère l’état local du like pour un rendu interactif
    ✅ Communique avec l’API Laravel via fetch ou via un fichier api.js externe-->
