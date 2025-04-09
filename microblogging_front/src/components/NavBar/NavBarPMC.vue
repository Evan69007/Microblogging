<template>
  <nav class="fixed top-0 left-0 right-0 bg-gray-800 text-white z-50 h-28">
    <div class="grid grid-cols-3 items-end h-full px-6 pb-2">
      <!-- Colonne 1 : Logo -->
      <div class="flex items-end justify-start ml-20">
        <Logo :class="'h-[120px] max-h-full w-auto ml-20 '" />
      </div>

      <!-- Colonne 2 : Boutons -->
      <div class="flex justify-center space-x-16 pb-4">
        <button
          class="bg-white text-black font-bold px-6 py-1 rounded-full border-4 border-green-800 hover:bg-gray-200 transition uppercase tracking-wide text-xl"
        >
          HOME
        </button>
        <button
          class="bg-gray-800 text-white font-bold px-6 py-1 rounded-full border-4 border-yellow-400 hover:bg-yellow-500 transition uppercase tracking-wide text-xl"
        >
          MON PROFIL
        </button>
        <button
          class="bg-gray-800 text-white font-bold px-6 py-1 rounded-full border-4 border-red-500 hover:bg-red-400 transition uppercase tracking-wide text-xl"
        >
          + POST
        </button>
      </div>

      <!-- Colonne 3 : Salut + bouton déconnexion séparés  -->
      <div class="flex items-center justify-end space-x-48 pb-4 text-xl">
        <span class="text-yellow-300">Salut {{ userName }}</span>
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
import Logo from "./Logo.vue";

const userName = "Laura";
function logout() {
  console.log("Déconnexion en cours...");
}
</script>
