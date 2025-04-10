<template>
  <!-- Barre de navigation fixe en haut de la page -->
  <nav class="fixed top-0 left-0 right-0 bg-gray-800 text-white z-50 h-28">
    <!-- Grille à 3 colonnes pour répartir : logo / boutons / user -->
    <div class="grid grid-cols-3 items-end h-full px-6 pb-2">
      <!-- Colonne 1 : Logo aligné en bas à gauche avec un décalage (ml-20) -->
      <div class="flex items-end justify-start ml-20">
        <!-- Le logo est grand (120px de haut), limité à la hauteur max de son conteneur -->
        <Logo :class="'h-[120px] max-h-full w-auto ml-20 '" />
      </div>

      <!-- Colonne 2 : Boutons de navigation centrés horizontalement -->
      <div class="flex justify-center space-x-16 pb-4">
        <!-- Bouton HOME -->
        <button
          class="bg-white text-black font-bold px-6 py-1 rounded-full border-4 border-green-800 hover:bg-gray-200 transition uppercase tracking-wide text-xl"
        >
          HOME
        </button>

        <!-- Bouton MON PROFIL -->
        <button
          class="bg-gray-800 text-white font-bold px-6 py-1 rounded-full border-4 border-yellow-400 hover:bg-yellow-500 transition uppercase tracking-wide text-xl"
        >
          MON PROFIL
        </button>

        <!-- Bouton + POST -->
        <button
          class="bg-gray-800 text-white font-bold px-6 py-1 rounded-full border-4 border-red-500 hover:bg-red-400 transition uppercase tracking-wide text-xl"
        >
          + POST
        </button>
      </div>

      <!-- Colonne 3 : Message de bienvenue + bouton de déconnexion alignés à droite -->
      <div class="flex items-center justify-end space-x-48 pb-4 text-xl">
        <!-- Message d'accueil personnalisé -->
        <span class="text-yellow-300">Salut {{ userName }}</span>

        <!-- Bouton de déconnexion -->
        <button
          @click="logout"
          class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full"
        >
          Déconnexion
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
// Import du composant Logo
import Logo from "./Logo.vue";

// Nom de l'utilisateur connecté (simulé ici)
const userName = "Laura";

// Fonction déclenchée au clic sur "Déconnexion"
function logout() {
  console.log("Déconnexion en cours...");
}
</script>
