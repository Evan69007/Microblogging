<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-800">
    <!-- Logo positionné à gauche et centré verticalement -->
    <div class="top-1/2 left-128 transform -translate-y-1/2 mt-128">
      <router-link to="/">
        <Logo class="w-128 h-auto" />
        <!-- Augmentation de la taille du logo -->
      </router-link>
    </div>

    <!-- Conteneur de la page de connexion centré à droite -->
    <div class="top-128 right-8 ml-64">
      <ConnexionContainer />
    </div>
  </div>
</template>

<script setup>
import ConnexionContainer from "@/components/Connexion/ConnexionContainer.vue"; // Importation du composant de connexion
import Logo from "@/components/NavBar/Logo.vue"; // Importation du logo
</script>

<style scoped>
/* Ajoute des styles spécifiques à cette vue si nécessaire */
</style>
