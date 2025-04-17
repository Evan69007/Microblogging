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
// 🧩 Import du composant de formulaire de connexion
import ConnexionContainer from "@/components/Connexion/ConnexionContainer.vue";

// 🎯 Import du composant Logo à afficher (souvent dans le header ou la page)
import Logo from "@/components/NavBar/Logo.vue";
</script>

<style scoped>
/* Ajoute des styles spécifiques à cette vue si nécessaire */
</style>

<!-- Ce fichier sert à importer les composants nécessaires à ta vue (probablement Connexion.vue), pour afficher :
    Le logo de l’application
    Le formulaire de connexion (contenu dans ConnexionContainer.vue)

 -->
