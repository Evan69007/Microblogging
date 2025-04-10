<template>
  <nav class="fixed top-0 left-0 right-0 bg-gray-800 text-white z-50 h-28">
    <div class="grid grid-cols-3 items-end h-full px-6 pb-2">
      <!-- Colonne 1 : Logo -->
      <div class="flex items-end justify-start ml-20">
        <Logo class="h-[120px] max-h-full w-auto ml-20" />
      </div>

      <!-- Colonne 2 : Boutons de navigation -->
      <div class="flex justify-center space-x-16 pb-4">
        <button
          @click="navigateTo('/')"
          class="bg-white text-black font-bold px-6 py-1 rounded-full border-4 border-green-800 hover:bg-gray-200 transition uppercase tracking-wide text-xl"
        >
          HOME
        </button>

        <button
          @click="navigateTo('/profil')"
          class="bg-gray-800 text-white font-bold px-6 py-1 rounded-full border-4 border-yellow-400 hover:bg-yellow-500 transition uppercase tracking-wide text-xl"
        >
          MON PROFIL
        </button>

        <button
          @click="navigateTo('/post')"
          class="bg-gray-800 text-white font-bold px-6 py-1 rounded-full border-4 border-red-500 hover:bg-red-400 transition uppercase tracking-wide text-xl"
        >
          + POST
        </button>
      </div>

      <!-- Colonne 3 : Message d'accueil + bouton de connexion/déconnexion -->
      <div class="flex items-center justify-end space-x-4 pb-4 text-xl">
        <div v-if="isUserLoggedIn">
          <span class="text-yellow-300">Bienvenue, {{ userName }}</span>
        </div>

        <button
          @click="logout"
          class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full"
        >
          {{ isUserLoggedIn ? "Déconnexion" : "Connexion" }}
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import Logo from "./Logo.vue";

const router = useRouter();

// Vérifie l'état de connexion de l'utilisateur depuis localStorage
const isUserLoggedIn = ref(localStorage.getItem("isUserLoggedIn") === "true");
const userName = ref(localStorage.getItem("userName") || ""); // Récupère le prénom de l'utilisateur

// Fonction de déconnexion
function logout() {
  localStorage.removeItem("isUserLoggedIn");
  localStorage.removeItem("userName");
  isUserLoggedIn.value = false;
  userName.value = "";
  router.push("/connexion"); // Rediriger vers la page de connexion
}

// Mettre à jour l'état de connexion lors du montage du composant
onMounted(() => {
  isUserLoggedIn.value = localStorage.getItem("isUserLoggedIn") === "true";
  userName.value = localStorage.getItem("userName") || "";
});

// Fonction de navigation
function navigateTo(route) {
  router.push(route);
}
</script>

<style scoped>
/* Styles spécifiques à la Navbar */
</style>
