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
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full"
          >
            Connexion
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, watch } from "vue"; // Import des hooks de composition
import { useRoute, useRouter } from "vue-router"; // Pour la navigation et surveillance de la route
import Logo from "./Logo.vue"; // (Utilisé dans le template de la navbar probablement)

// Initialisation des outils de navigation
const router = useRouter();
const route = useRoute();

// Reactive refs pour suivre l'état de connexion
const isConnected = ref(false); // Booléen : l'utilisateur est-il connecté ?
const userName = ref(""); // Nom affiché dans la navbar (si connecté)

// 🔒 Fonction de déconnexion utilisateur
async function logout() {
  try {
    // Récupération du token depuis la session
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));

    // Récupération des données utilisateur via token
    const user = await fetch("http://localhost:8000/api/user", {
      headers: {
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
        Accept: "application/json",
      },
    });
    const user_data = await user.json();

    // Appel de l'API pour se déconnecter
    const response = await fetch(`http://localhost:8000/api/logout`, {
      method: "POST",
      headers: {
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(user_data), // Pas nécessaire ici mais ok
    });

    const data = await response.json();

    // Si la déconnexion a réussi
    if (data.message === "User disconnected") {
      isConnected.value = false;
      userName.value = "";

      // Suppression des données locales
      sessionStorage.removeItem("access_token");
      sessionStorage.removeItem("userName");

      // Redirection vers la page de connexion
      router.push("/connexion");
    }
  } catch (error) {
    console.error("Error:", error); // En cas d'erreur
  }
}

// ✅ Fonction pour vérifier si l'utilisateur est connecté
function checkConnection() {
  isConnected.value = !!sessionStorage.getItem("access_token"); // Booléen
  userName.value = sessionStorage.getItem("userName") || ""; // Nom affiché
}

// Appelé au moment du montage du composant (quand la navbar est affichée)
onMounted(() => {
  checkConnection(); // Vérifie la session active
});

// Surveille les changements de route pour garder l’état de connexion à jour
watch(
  () => route.path, // À chaque changement de route
  () => {
    checkConnection(); // On re-vérifie l'état de session
  }
);

// 🔁 Fonction utilitaire pour rediriger vers une route
function navigateTo(route) {
  router.push(route);
}
</script>

<!-- Ce script fait partie de la Navbar, et son rôle est de :
    ✅ Détecter si l’utilisateur est connecté à l’application
    ✅ Afficher dynamiquement son nom ou les liens appropriés (connexion / déconnexion)
    ✅ Permettre la déconnexion sécurisée via l’API Laravel
    ✅ Réagir aux changements de route pour mettre à jour l’état de connexion automatiquement -->
