<template>
  <nav
    class="fixed top-0 left-0 right-0 bg-gray-800 text-white z-50 h-32 pb-16"
  >
    <div class="grid grid-cols-3 items-center h-8 px-6 pb-16">
      <!-- Colonne 1 : Logo -->
      <div class="flex items-center justify-start ml-4 lg:ml-20 mt-0">
        <Logo class="w-32 max-w-48 h-auto" />
      </div>

      <!-- Colonne 2 : Boutons de navigation -->
      <div class="flex justify-center space-x-8 lg:space-x-16 pb-2 mt-0">
        <button
          @click="navigateTo('/')"
          class="bg-gray-800 text-white font-bold px-4 py-1 rounded-full border-4 border-green-800 hover:bg-green-900 transition uppercase tracking-wide text-base lg:text-xl"
        >
          HOME
        </button>

        <!-- Boutons affichés uniquement si l'utilisateur est connecté -->
        <button
          v-if="isConnected"
          @click="navigateTo('/profil')"
          class="bg-gray-800 text-white font-bold px-4 py-1 rounded-full border-4 border-yellow-400 hover:bg-yellow-500 transition uppercase tracking-wide text-base lg:text-xl"
        >
          PROFIL
        </button>

        <button
          v-if="isConnected"
          @click="navigateTo('/post')"
          class="bg-gray-800 text-white font-bold px-4 py-1 rounded-full border-4 border-orange-600 hover:bg-orange-700 transition uppercase tracking-wide text-base lg:text-xl"
        >
          +POST
        </button>
      </div>

      <!-- Colonne 3 : Message d'accueil + bouton de connexion/déconnexion -->
      <div
        class="flex items-center justify-end space-x-4 pb-4 text-base lg:text-xl"
      >
        <div v-if="isConnected">
          <span class="text-yellow-300 md-5">Bienvenue, {{ userName }}</span>
          <button
            @click="logout()"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full ml-32"
          >
            Déconnexion
          </button>
        </div>

        <div v-else>
          <button
            @click="navigateTo('/connexion')"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full ml-32"
          >
            Connexion
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import Logo from "./Logo.vue";

const router = useRouter();
const route = useRoute();
const isConnected = ref(false);
const userName = ref("");

async function logout() {
  try {
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));
    const user = await fetch("http://localhost:8000/api/user", {
      headers: {
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
        Accept: "application/json",
      },
    });
    const user_data = await user.json();
    const response = await fetch(`http://localhost:8000/api/logout`, {
      method: "POST",
      headers: {
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(user_data),
    });
    const data = await response.json();
    if (data.message === "User disconnected") {
      isConnected.value = false;
      userName.value = "";
      sessionStorage.removeItem("access_token");
      sessionStorage.removeItem("userName");
      router.push("/connexion");
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

function checkConnection() {
  isConnected.value = !!sessionStorage.getItem("access_token");
  userName.value = sessionStorage.getItem("userName") || "";
}

// Mettre à jour l'état de connexion lors du montage du composant
onMounted(() => {
  checkConnection();
});

watch(
  () => route.path, // Watch the route path
  () => {
    checkConnection(); // Call checkConnection when the route changes
  }
);

// Fonction de navigation
function navigateTo(route) {
  router.push(route);
}
</script>

<style scoped>
/* Styles spécifiques à la Navbar */
</style>
