<template>
  <div
    class="min-h-screen bg-gray-800 py-6 flex flex-col justify-center sm:py-12"
  >
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
      <div
        class="relative px-4 py-10 bg-gray-900 mx-8 md:mx-0 shadow rounded-3xl sm:p-10"
      >
        <div class="max-w-md mx-auto">
          <div class="divide-y divide-gray-700">
            <div
              class="py-8 text-base leading-6 space-y-4 text-gray-300 sm:text-lg sm:leading-7"
            >
              <div class="flex flex-col">
                <label class="leading-loose text-orange-400">Titre</label>
                <input
                  type="text"
                  v-model="newPost.titre"
                  class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-700 rounded-md bg-gray-800 text-white"
                  placeholder="Titre de votre post"
                />
              </div>
              <div class="flex flex-col">
                <label class="leading-loose text-orange-400">Description</label>
                <textarea
                  v-model="newPost.description"
                  class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-700 rounded-md bg-gray-800 text-white"
                  rows="4"
                  placeholder="Contenu de votre post"
                ></textarea>
              </div>
            </div>
            <div class="pt-4 flex items-center space-x-4">
              <button
                @click="submitPost"
                class="bg-orange-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none hover:bg-orange-600"
              >
                Publier
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "@/services/api.js";

const router = useRouter();
const newPost = ref({
  titre: "",
  description: "",
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

    const postData = {
      titre: newPost.value.titre,
      description: newPost.value.description,
      user_id: userInfo.id,
    };

    await api.createPost(postData);
    router.push("/");
  } catch (error) {
    console.error("Erreur lors de la création du post:", error);
  }
}
</script>
