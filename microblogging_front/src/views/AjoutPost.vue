<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "@/services/api.js";

const router = useRouter();
const newPost = ref({
  titre: "",
  description: "",
  hashtags: "",
});

async function submitPost() {
  try {
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));
    const response = await fetch("http://localhost:8000/api/user", {
      headers: {
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
        Accept: "application/json",
      },
    });
    const userInfo = await response.json();
    if (!userInfo) {
      console.error("Utilisateur non connecté");
      return;
    }
    if (newPost.value.hashtags) {
      newPost.value.hashtags = newPost.value.hashtags.split(", ");
    } else {
    }
    const postData = {
      titre: newPost.value.titre,
      description: newPost.value.description,
      hashtags: newPost.value.hashtags,
      user_id: userInfo.id,
    };

    await api.createPost(postData);
    router.push("/");
  } catch (error) {
    console.error("Erreur lors de la création du post:", error);
  }
}
</script>

<template>
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <div class="flex justify-center">
      <div class="w-full max-w-4xl bg-gray-900 p-6 rounded-xl shadow-lg">
        <h2 class="text-3xl text-gray-400 mb-4">Ajouter un Post</h2>

        <!-- Formulaire de modification de post -->
        <form @submit.prevent="submitPost">
          <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-300"
              >Titre</label
            >
            <input
              id="title"
              v-model="newPost.titre"
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
              v-model="newPost.description"
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
              v-model="newPost.hashtags"
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
              Ajouter le Post
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
