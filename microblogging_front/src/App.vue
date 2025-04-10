<script setup>
// Importation du système de routing (affiche la vue selon l'URL)
import { RouterView } from "vue-router";

// Import de la barre de navigation principale
import NavBar from "./components/NavBar/NavBarPMC.vue";
</script>

<template>
  <div class="app">
    <!-- Barre de navigation visible sur toutes les pages -->
    <NavBar />

    <!-- Zone de contenu principal (vue dynamique injectée ici) -->
    <main class="pt-28">
      <!-- pt-28 : padding top de 7rem (112px) pour éviter que la navbar en position fixed masque le contenu -->
      <RouterView />
    </main>
  </div>
</template>

<style>
/* Classe globale de l'application : prend toute la hauteur de l'écran + couleur de fond */
.app {
  min-height: 100vh;
  background-color: #f5f5f5;
}
</style>
