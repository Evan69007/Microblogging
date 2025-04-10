<template>
  <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl text-gray-400 mb-4">Biographie</h2>
    <p class="text-lg text-gray-300">{{ biography }}</p>
  </div>
</template>

<script setup>
// Prop pour recevoir la biographie de l'utilisateur
defineProps({
  biography: {
    type: String,
    required: true,
  },
});
</script>

<style scoped>
/* Styles spécifiques à la biographie */
</style>
