<template>
  <div class="w-128 max-w-lg bg-white p-12 rounded-xl shadow-lg">
    <!-- Contenu du formulaire de connexion -->
    <form @submit.prevent="submitForm">
      <div class="mb-6">
        <label for="email" class="block text-sm font-medium text-gray-700"
          >E-mail</label
        >
        <input
          id="email"
          v-model="formData.email"
          type="email"
          placeholder="Votre email"
          class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
        />
      </div>

      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700"
          >Mot de passe</label
        >
        <input
          id="password"
          v-model="formData.password"
          type="password"
          placeholder="Votre mot de passe"
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
</template>

<script>
import Logo from "../NavBar/Logo.vue"; // Importation du composant Logo
import { ref } from "vue";
import { useRouter } from "vue-router";

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
          try {
            const access_token = JSON.parse(
              sessionStorage.getItem("access_token")
            );
            const user = await fetch("http://localhost:8000/api/user", {
              headers: {
                Authorization: `${access_token.token_type} ${access_token.access_token}`,
                Accept: "application/json",
              },
            });
            const user_data = await user.json();
            sessionStorage.setItem("userName", user_data.name);
          } catch (error) {
            console.error("Error: ", error);
          }

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
