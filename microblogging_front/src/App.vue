<script setup>
import { RouterView } from "vue-router";
import NavBar from "./components/NavBar/NavBarPMC.vue";
</script>

<template>
  <RouterView />
  <div class="app">
    <div class="pt-16">
      <header><NavBar /></header>
      <main class="container">
        <!-- Affiche la page en fonction de la route définie dans index.js -->
      </main>
      <!-- <footer>
        <FooterComponent />
      </footer> -->
    </div>
  </div>
</template>

<style>
.app-container {
  width: 100%;
  min-height: 100vh;
  background-color: #f5f5f5;
}

.content-container {
  width: 100%;
}
</style>
