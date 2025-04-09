<template>
  <div class="max-w-3xl mx-auto pt-28 space-y-6 px-4">
    <!-- Liste des posts triés -->
    <PostCard v-for="post in sortedPosts" :key="post.id" :post="post" />
  </div>
</template>

<script setup>
import PostCard from "./PostCard.vue";
import { computed } from "vue";

const props = defineProps({
  posts: {
    type: Array,
    required: true,
  },
});

// Tri du plus récent au plus ancien (en supposant le format "dd/mm/yyyy")
const sortedPosts = computed(() => {
  return [...props.posts].sort((a, b) => {
    const [d1, m1, y1] = a.date.split("/").map(Number);
    const [d2, m2, y2] = b.date.split("/").map(Number);
    return new Date(y2, m2 - 1, d2) - new Date(y1, m1 - 1, d1);
  });
});
</script>
