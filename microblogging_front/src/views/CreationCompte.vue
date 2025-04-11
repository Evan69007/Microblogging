<template>
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <div class="flex justify-center">
      <div class="w-full max-w-4xl bg-gray-900 p-6 rounded-xl shadow-lg">
        <h2 class="text-3xl text-gray-400 mb-4">Créer un Compte</h2>

        <!-- Formulaire de création de compte -->
        <form @submit.prevent="submitForm">
          <div class="mb-6">
            <label
              for="username"
              class="block text-sm font-medium text-gray-300"
              >Nom d'utilisateur</label
            >
            <input
              id="username"
              v-model="form.username"
              type="text"
              placeholder="Nom d'utilisateur"
              class="w-full p-3 border border-gray-300 rounded-md mt-2"
              required
            />
          </div>

          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-300"
              >Email</label
            >
            <input
              id="email"
              v-model="form.email"
              type="email"
              placeholder="email@exemple.com"
              class="w-full p-3 border border-gray-300 rounded-md mt-2"
              required
            />
          </div>

          <div class="mb-6">
            <label
              for="password"
              class="block text-sm font-medium text-gray-300"
              >Mot de passe</label
            >
            <input
              id="password"
              v-model="form.password"
              type="password"
              placeholder="Mot de passe"
              class="w-full p-3 border border-gray-300 rounded-md mt-2"
              required
            />
          </div>

          <div class="mb-6">
            <label
              for="confirmPassword"
              class="block text-sm font-medium text-gray-300"
              >Confirmer le mot de passe</label
            >
            <input
              id="confirmPassword"
              v-model="form.confirmPassword"
              type="password"
              placeholder="Confirmez votre mot de passe"
              class="w-full p-3 border border-gray-300 rounded-md mt-2"
              required
            />
          </div>

          <!-- Intégration du composant Biography -->
          <Biography
            :biography="form.biography"
            @updateBiography="updateBiography"
          />

          <div>
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Soumettre
            </button>
          </div>
        </form>

        <!-- Lien pour rediriger vers la connexion si l'utilisateur est déjà enregistré -->
        <div class="text-center mt-4">
          <p class="text-gray-600">
            Vous avez déjà un compte ?
            <router-link
              to="/connexion"
              class="text-orange-600 hover:text-orange-700"
              >Se connecter</router-link
            >
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import Biography from "@/components/Profil/Biography.vue"; // Assure-toi que le composant Biography est bien importé

// Formulaire de création de compte / modification de profil
const form = ref({
  username: "",
  email: "",
  password: "",
  confirmPassword: "",
  biography: "",
});

// Fonction pour soumettre le formulaire
function submitForm() {
  // Validation du mot de passe
  if (form.value.password !== form.value.confirmPassword) {
    alert("Les mots de passe ne correspondent pas.");
    return;
  }

  // Logique pour envoyer le formulaire à l'API ou à une autre logique
  console.log("Formulaire soumis :", form.value);

  // Si c'est la création de compte, on peut rediriger l'utilisateur
  // ou afficher un message de succès.
  // Pour l'instant, on réinitialise le formulaire après soumission.
  form.value = {
    username: "",
    email: "",
    password: "",
    confirmPassword: "",
    biography: "",
  };
}

// Fonction pour mettre à jour la biographie
function updateBiography(newBiography) {
  form.value.biography = newBiography;
}
</script>

<style scoped>
/* Styles spécifiques au formulaire de création de compte */
</style>
