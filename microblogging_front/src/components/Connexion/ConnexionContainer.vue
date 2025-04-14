<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-800">
    <div class="flex w-full max-w-7xl">
      <div class="flex-1 p-8 flex justify-center items-center">
        <Logo class="w-120" />
      </div>

      <div class="flex-1 bg-white p-8 rounded-xl shadow-lg mt-32">
        <div class="text-center mb-6">
          <h2 class="text-2xl text-gray-600 mb-2">Connexion</h2>
          <div class="text-sm text-gray-500 mb-4">Entrez vos identifiants</div>
        </div>

        <form @submit.prevent="submitForm">
          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700"
              >E-mail</label
            >
            <input
              id="email"
              v-model="formData.email"
              type="email"
              placeholder="email..."
              class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
          </div>

          <div class="mb-6">
            <label
              for="password"
              class="block text-sm font-medium text-gray-700"
              >Mot de passe</label
            >
            <input
              id="password"
              v-model="formData.password"
              type="password"
              placeholder="Mot de passe..."
              class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
          </div>

          <div class="mb-6">
            <button
              type="submit"
              class="w-full bg-orange-600 text-white py-3 rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
              Connexion
            </button>
          </div>

          <div class="text-center mb-6">
            <a href="#" class="text-sm text-gray-600 hover:text-orange-500"
              >Mot de passe oublié</a
            >
          </div>
        </form>

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

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";
/* import axios from "axios"; */
import Logo from "@/components/NavBar/Logo.vue"; // Importation du composant Logo

export default {
  setup() {
    const router = useRouter();
    const formData = ref({
      email: "",
      password: "",
    });

    const submitForm = async () => {
      try {
        const response = await fetch("http://localhost:8000/api/login", {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData.value),
        });
        /* const response = await axios.post(
          "http://localhost:8000/api/login",
          formData.value,
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        ); */
        const data = await response.json();
        if (data.access_token) {
          sessionStorage.setItem("access_token", JSON.stringify(data));
          router.push("/");
        }
      } catch (error) {
        console.error("Error:", error);
      }
    };

    // Return formData so it's available in the template
    return { formData, submitForm };
  },
};
</script>
