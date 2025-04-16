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
import { ref, onMounted } from "vue";

import PostList from "@/components/Posts/PostList.vue";
import api from "@/services/api.js";

const posts = ref([]);

const fetchPosts = async () => {
  const response = await api.getPosts();
  console.log("Données chargées :", response);
  posts.value = response;
};

onMounted(() => {
  fetchPosts();
});
</script>

<style scoped>
/* Styles spécifiques à la page d'accueil */
</style>
