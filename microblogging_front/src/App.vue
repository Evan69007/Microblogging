<template>
  <div id="app">
    <!-- Masquer la navbar si la route est '/connexion' -->
    <NavBar v-if="!isConnexionPage" />
    <!-- La navbar sera masquée sur la page de connexion -->

    <!-- Affichage de la vue active (vue de la route actuelle) -->
    <router-view />
  </div>
</template>

<script setup>
import { computed } from "vue"; // Import de computed pour les valeurs réactives dérivées
import { useRoute } from "vue-router"; // Import pour accéder à la route actuelle
import NavBar from "@/components/NavBar/NavBarPMC.vue"; // Importation de la barre de navigation (NavBar)

// 📍 Récupère les informations de la route en cours (URL active)
const route = useRoute();

// ✅ Computed pour déterminer si on se trouve sur la page de connexion
// Si la route actuelle est '/connexion', la NavBar peut être masquée
const isConnexionPage = computed(() => route.path === "/connexion");
</script>

<style scoped>
/* Tu peux ajouter des styles supplémentaires ici si nécessaire */
</style>

<!-- Ce code est utilisé pour conditionner l'affichage de la NavBar :
    Lorsque l'utilisateur est sur la page /connexion, on peut masquer la barre de navigation.
    Cela permet d'avoir une interface plus claire lors de la connexion (ou lors de l'inscription si on étend cette logique). -->
