<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-800">
    <!-- Conteneur principal avec deux colonnes -->
    <div class="flex w-full max-w-7xl">
      <!-- Logo Section à gauche -->
      <div class="flex-1 p-8 flex justify-center items-center">
        <Logo class="w- 120" />
        <!-- Agrandir le logo en ajustant la largeur -->
      </div>

      <!-- Form Section à droite -->
      <div class="flex-1 bg-white p-8 rounded-xl shadow-lg mt-32">
        <!-- Testons avec mt-16 pour plus d'espace -->
        <div class="text-center mb-6">
          <h2 class="text-2xl text-gray-600 mb-2">Connexion</h2>
          <div class="text-sm text-gray-500 mb-4">Entrez vos identifiants</div>
        </div>

        <!-- Form -->
        <form @submit.prevent="submitForm">
          <!-- Email Input -->
          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700"
              >E-mail</label
            >
            <input
              id="email"
              v-model="email"
              type="email"
              placeholder="email..."
              class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
          </div>

          <!-- Password Input -->
          <div class="mb-6">
            <label
              for="password"
              class="block text-sm font-medium text-gray-700"
              >Mot de passe</label
            >
            <input
              id="password"
              v-model="password"
              type="password"
              placeholder="Mot de passe..."
              class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
          </div>

          <!-- Submit Button -->
          <div class="mb-6">
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Connexion
            </button>
          </div>

          <!-- Mot de passe oublié -->
          <div class="text-center mb-6">
            <a href="#" class="text-sm text-gray-600 hover:text-orange-500"
              >Mot de passe oublié</a
            >
          </div>
        </form>

        <!-- Registration Link -->
        <div class="text-center">
          <p class="text-gray-600">Pas encore de compte ?</p>
          <router-link
            to="/creation-compte"
            class="text-sm text-orange-600 hover:text-orange-700"
          >
            Créer un compte
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import Logo from "@/components/NavBar/Logo.vue"; // Importation du composant Logo

const email = ref("");
const password = ref("");
const error = ref("");
const router = useRouter();

const fakeUsers = [
  { email: "laura@mail.com", password: "123456" },
  { email: "john@mail.com", password: "azerty" },
];

function submitForm() {
  const user = fakeUsers.find(
    (u) => u.email === email.value && u.password === password.value
  );

  if (user) {
    router.push("/profil");
  } else {
    error.value = "Email ou mot de passe incorrect";
  }
}
</script>

<style scoped>
/* Ajoute des styles personnalisés ici si nécessaire */
</style>
