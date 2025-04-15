<template>
  <div class="space-y-6">
    <div
      v-if="posts.length === 0"
      class="text-center text-gray-400 bg-gray-800 rounded-md p-6"
    >
      Aucun post à afficher
    </div>
    <div
      v-else
      v-for="post in sortedPosts"
      :key="post.id"
      class="bg-gray-800 rounded-md shadow p-4"
    >
      <PostCard
        :post="post"
        @delete="$emit('delete-post', post.id)"
        @edit="$emit('edit-post', post.id, $event)"
      />
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import PostCard from "./PostCard.vue";

const props = defineProps({
  posts: {
    type: Array,
    default: () => [],
  },
});

defineEmits(["delete-post", "edit-post"]);

const sortedPosts = computed(() => {
  return [...props.posts].sort((a, b) => b.id - a.id);
});
</script>
