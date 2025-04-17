<template>
  <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl text-gray-400 mb-4">Biographie</h2>
    <p class="text-lg text-gray-300">{{ biography }}</p>
  </div>
</template>

<script setup>
// 📥 Ce composant reçoit une biographie (chaîne de caractères) depuis son parent
defineProps({
  biography: {
    type: String, // La biographie est une chaîne
    required: true, // Elle est obligatoire pour afficher le contenu
  },
});
</script>
<!-- Ce composant est destiné à afficher la biographie d’un utilisateur, reçue comme prop, dans une carte ou une section de profil. -->
