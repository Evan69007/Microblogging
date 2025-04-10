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
import { computed } from "vue";
import { useRoute } from "vue-router";
import NavBar from "@/components/NavBar/NavBarPMC.vue"; // Assure-toi que ta navbar est importée

// Utilise la route actuelle pour déterminer si on est sur la page de connexion
const route = useRoute();
const isConnexionPage = computed(() => route.path === "/connexion"); // Si la route est '/connexion', on cache la navbar
</script>

<style scoped>
/* Tu peux ajouter des styles supplémentaires ici si nécessaire */
</style>
