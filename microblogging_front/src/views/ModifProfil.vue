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
          <BiographyInput v-model="formData.biographie" />

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
  biographie: "",
  password: "",
});

const router = useRouter();

// Fonction pour récupérer les données de l'utilisateur lors du chargement du composant
onMounted(async () => {
  try {
    // Récupérer les informations actuelles de l'utilisateur
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));
    const response = await fetch("http://localhost:8000/api/user", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `${access_token.token_type} ${access_token.access_token}`, // Remplacer par le token d'authentification de l'utilisateur
      },
    });
    const data = await response.json();
    const profil = await fetch(
      `http://localhost:8000/api/Profil_Users/${data.id}`
    );
    const profil_data = await profil.json();

    if (response.ok && profil.ok) {
      // Remplir le formulaire avec les données actuelles de l'utilisateur
      formData.value.name = data.name;
      formData.value.email = data.email;
      formData.value.biographie = profil_data.biographie;
    } else {
      alert("Erreur lors de la récupération des données.");
    }
  } catch (error) {
    console.error(
      "Erreur lors de l'appel API pour récupérer les données :\n",
      error
    );
  }
});

// Fonction de soumission pour sauvegarder les modifications dans l'API
const submitForm = async () => {
  if (formData.value.password.length === 0) {
    delete formData.value.password;
  }
  try {
    // Envoi des données à l'API pour sauvegarder la biographie
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));
    const response = await fetch("http://localhost:8000/api/user/update", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `${access_token.token_type} ${access_token.access_token}`, // Remplacer par le token d'authentification
      },
      body: JSON.stringify(formData.value),
    });

    if (response.ok) {
      const data = await response.json();
      alert("Profil mis à jour !");
      // Redirection vers Profil.vue avec la biographie mise à jour
      router.push("/profil");
    } else {
      alert("Erreur lors de la mise à jour du profil.");
    }
  } catch (error) {
    console.error("Erreur lors de l'appel API :", error);
  }
};
</script>

<style scoped>
/* Styles spécifiques à ModifProfil.vue */
</style>
