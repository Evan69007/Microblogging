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
// 📦 Imports Vue
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

// 🧩 Importation des composants enfants du formulaire
import NomInput from "@/components/ModifProfil/NomInput.vue";
import EmailInput from "@/components/ModifProfil/EmailInput.vue";
import BiographyInput from "@/components/ModifProfil/BiographyInput.vue";
import PasswordInput from "@/components/ModifProfil/PasswordInput.vue";

// 📄 Données du formulaire pour modifier le profil
const formData = ref({
  name: "", // Nom de l'utilisateur
  email: "", // Email
  biographie: "", // Bio
  password: "", // Nouveau mot de passe (optionnel)
});

// 🔁 Récupération des infos utilisateur connecté
const router = useRouter();

// ⏱️ Dès que le composant est monté, on récupère les données utilisateur + sa bio
onMounted(async () => {
  try {
    // 🔐 Récupération du token d'accès depuis sessionStorage
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));

    // 👤 Récupération des données de l'utilisateur via son token
    const response = await fetch("http://localhost:8000/api/user", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
      },
    });
    const data = await response.json();

    // 🧠 Récupération de la biographie (stockée séparément)
    const profil = await fetch(
      `http://localhost:8000/api/Profil_Users/${data.id}`
    );
    const profil_data = await profil.json();

    // ✅ Si tout est OK, on remplit les champs du formulaire
    if (response.ok && profil.ok) {
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

// 📨 Fonction appelée à la soumission du formulaire
const submitForm = async () => {
  // 🧼 Si le mot de passe n'a pas été modifié, on ne l'envoie pas
  if (formData.value.password.length === 0) {
    delete formData.value.password;
  }

  try {
    // 🔐 Récupération du token d'accès
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));

    // 🔄 Requête PUT pour mettre à jour le profil + bio
    const response = await fetch("http://localhost:8000/api/user/update", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
      },
      body: JSON.stringify(formData.value),
    });

    // ✅ Si la réponse est OK
    if (response.ok) {
      const data = await response.json();
      sessionStorage.setItem("userName", formData.value.name);
      alert("Profil mis à jour !");
      router.push("/profil"); // Redirection vers la page profil
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

<!-- Ce script gère la modification du profil utilisateur, en :
    Récupérant les infos actuelles (nom, mail, bio)
    Pré-remplissant le formulaire avec les valeurs existantes
    Permettant de modifier et enregistrer les nouvelles valeurs
    Met à jour à la fois la table users et profil_users -->
