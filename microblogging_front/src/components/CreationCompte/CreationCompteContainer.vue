<template>
  <!-- Fond général de la page avec couleur sombre -->
  <div class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <!-- Centre le formulaire horizontalement -->
    <div class="flex justify-center">
      <!-- Conteneur du formulaire avec fond et ombre -->
      <div class="w-full max-w-4xl bg-gray-900 p-6 rounded-xl shadow-lg">
        <!-- Titre de la page -->
        <h2 class="text-3xl text-gray-400 mb-4">Créer un Compte</h2>

        <!-- Formulaire de création de compte -->
        <form @submit.prevent="submitForm">
          <!-- Champ nom -->
          <div class="mb-6">
            <label
              for="username"
              class="block text-sm font-medium text-gray-300"
            >
              Nom d'utilisateur
            </label>
            <input
              id="username"
              v-model="form.name"
              type="text"
              placeholder="Nom d'utilisateur"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
              required
            />
          </div>

          <!-- Champ email -->
          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-300">
              Email
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              placeholder="email@exemple.com"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
              required
            />
          </div>

          <!-- Champ mot de passe -->
          <div class="mb-6">
            <label
              for="password"
              class="block text-sm font-medium text-gray-300"
            >
              Mot de passe
            </label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              placeholder="Mot de passe"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
              required
            />
          </div>

          <!-- Champ confirmation du mot de passe -->
          <div class="mb-6">
            <label
              for="confirmPassword"
              class="block text-sm font-medium text-gray-300"
            >
              Confirmer le mot de passe
            </label>
            <input
              id="confirmPassword"
              v-model="form.confirmPassword"
              type="password"
              placeholder="Confirmez votre mot de passe"
              class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
              required
            />
          </div>

          <!-- Bouton de soumission -->
          <div>
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Soumettre
            </button>
          </div>
        </form>

        <!-- Lien vers la page de connexion -->
        <div class="text-center mt-4">
          <p class="text-gray-600">
            Vous avez déjà un compte ?
            <router-link
              to="/connexion"
              class="text-orange-600 hover:text-orange-700"
            >
              Se connecter
            </router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue"; // pour les données réactives
import { useRouter } from "vue-router"; // pour la navigation
import Biography from "../Profil/Biography.vue"; // (importé mais pas utilisé ici)

// Déclaration des champs du formulaire
const form = ref({
  name: "",
  email: "",
  password: "",
  confirmPassword: "",
});

const router = useRouter(); // initialisation du routeur

// Fonction exécutée lors de la soumission du formulaire
async function submitForm() {
  // Vérifie que les deux mots de passe sont identiques
  if (form.value.password !== form.value.confirmPassword) {
    alert("Les mots de passe ne correspondent pas.");
    return;
  }

  try {
    // 🔐 Appel à l'API Laravel pour créer un utilisateur
    const response = await fetch("http://localhost:8000/api/register", {
      method: "POST",
      headers: {
        "Content-type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(form.value),
    });

    const data = await response.json();

    // Stocke uniquement le token (on enlève les données user ici)
    delete data.user;

    // Enregistre les infos en session
    sessionStorage.setItem("access_token", JSON.stringify(data));
    sessionStorage.setItem("userName", JSON.stringify(form.value.name));

    // 🔁 Récupération des infos du user via token pour avoir son ID
    const access_token = JSON.parse(sessionStorage.getItem("access_token"));
    const user = await fetch("http://localhost:8000/api/user", {
      headers: {
        Authorization: `${access_token.token_type} ${access_token.access_token}`,
        Accept: "application/json",
      },
    });
    const user_data = await user.json();

    // 📄 Création d’un profil vide pour l'utilisateur (biographie vide par défaut)
    await fetch("http://localhost:8000/api/Profil_Users", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({
        user_id: user_data.id,
        biographie: "",
      }),
    });

    // ✅ Redirige vers la page de modification de profil
    router.push(`/modif-profil/${user_data.id}`);
  } catch (error) {
    console.error("Error: ", error);
  }
}
</script>

<style scoped>
/* Tu peux ajouter ici des styles personnalisés si besoin */
</style>

<!-- Ce composant Vue a pour but principal de gérer la création d’un nouveau compte utilisateur dans ton application PushMyCode :
Il permet de :
    Renseigner les informations personnelles de base : nom, email, mot de passe
    Vérifier la confirmation du mot de passe
    Créer l’utilisateur dans la base via ton API Laravel
    Générer un token d’accès et récupérer l’utilisateur connecté
    Créer automatiquement un profil associé vide
    Rediriger vers la page /modif-profil/:id pour personnaliser la biographie -->
