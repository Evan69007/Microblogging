<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-800">
    <div class="flex w-full max-w-7xl">
      <div class="flex-1 bg-white p-8 rounded-xl shadow-lg mt-32">
        <div class="text-center mb-6">
          <h2 class="text-2xl text-gray-600 mb-2">Modifier le profil</h2>
          <div class="text-sm text-gray-500 mb-4">
            Modifiez vos informations personnelles
          </div>
        </div>

        <!-- Formulaire de modification du profil -->
        <form @submit.prevent="submitForm">
          <!-- Nom -->
          <NomInput v-model="formData.name" />

          <!-- Email -->
          <EmailInput v-model="formData.email" />

          <!-- Biographie -->
          <BiographyInput v-model="formData.biography" />

          <!-- Mot de passe -->
          <PasswordInput v-model="formData.password" />

          <div class="mb-6">
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Sauvegarder les modifications
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import NomInput from "@/components/ModifProfil/NomInput.vue";
import EmailInput from "@/components/ModifProfil/EmailInput.vue";
import BiographyInput from "@/components/ModifProfil/BiographyInput.vue"; // Importation du composant BiographyInput
import PasswordInput from "@/components/ModifProfil/PasswordInput.vue";

const formData = ref({
  name: "",
  email: "",
  biography: "",
  password: "",
});

const router = useRouter();

// Fonction pour récupérer les données de l'utilisateur lors du chargement du composant
onMounted(async () => {
  try {
    // Récupérer les informations actuelles de l'utilisateur
    const response = await fetch("http://localhost:8000/api/user", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${yourAccessToken}`, // Remplacer par le token d'authentification de l'utilisateur
      },
    });

    if (response.ok) {
      const data = await response.json();
      // Remplir le formulaire avec les données actuelles de l'utilisateur
      formData.value.name = data.name;
      formData.value.email = data.email;
      formData.value.biography = data.biography;
    } else {
      alert("Erreur lors de la récupération des données.");
    }
  } catch (error) {
    console.error(
      "Erreur lors de l'appel API pour récupérer les données :",
      error
    );
    alert("Erreur de connexion à l'API.");
  }
});

// Fonction de soumission pour sauvegarder les modifications dans l'API
const submitForm = async () => {
  try {
    // Envoi des données à l'API pour sauvegarder la biographie
    const response = await fetch("http://localhost:8000/api/user/update", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${yourAccessToken}`, // Remplacer par le token d'authentification
      },
      body: JSON.stringify({
        name: formData.value.name,
        email: formData.value.email,
        biography: formData.value.biography,
        password: formData.value.password,
      }),
    });

    const data = await response.json();
    if (response.ok) {
      alert("Profil mis à jour !");
      // Redirection vers Profil.vue avec la biographie mise à jour
      router.push({
        name: "profil", // Nom de la vue Profil
        query: { updatedBiography: formData.value.biography }, // Passer la biographie modifiée via query params
      });
    } else {
      alert("Erreur lors de la mise à jour du profil.");
    }
  } catch (error) {
    console.error("Erreur lors de l'appel API :", error);
    alert("Erreur de connexion à l'API.");
  }
};
</script>

<style scoped>
/* Styles spécifiques à ModifProfil.vue */
</style>
