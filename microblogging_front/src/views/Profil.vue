<template>
  <div v-if="isLoading">Chagement en cours...</div>
  <div v-else class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <!-- Bouton "Modifier Profil" -->
    <div class="absolute top-32 left-192 z-10">
      <button
        @click="editProfile(user.id)"
        class="bg-green-800 text-white py-2 px-6 rounded-md hover:bg-orange-700 transition"
      >
        Modifier Profil
      </button>
    </div>
    <!-- Conteneur en flex pour la biographie et les posts -->
    <div class="flex gap-16 pt-16 px-16 items-stretch">
      <!-- Section Biographie (à gauche) -->
      <div
        class="flex-1 text-center bg-gray-900 p-6 rounded-xl shadow-lg max-h-[500px] sticky top-32"
      >
        <h2 class="text-5xl text-gray-400 mb-4">Biographie</h2>
        <p class="text-7xl text-yellow-300 font-bold">{{ user.name }}</p>
        <p class="text-2xl text-gray-300 mt-16">
          {{ user.profil__users[0].biographie }}
        </p>
      </div>

      <!-- Section Posts de l'utilisateur (à droite) -->
      <div class="flex-1 max-w-5xl mx-auto pt-1 space-y-8 px-2 overflow-y-auto">
        <!-- Affichage de tous les posts de l'utilisateur -->
        <div v-for="(post, index) in userPosts" :key="index">
          <PostCard
            :post="post"
            @editPost="editPost"
            @deletePost="deletePost"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PostCard from "@/components/Posts/PostCard.vue"; // Composant pour afficher un post
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

export default {
  // 🔧 Déclaration des composants enfants utilisés dans ce composant
  components: {
    PostCard,
  },

  // 🎯 Données réactives pour la partie Options API
  data() {
    return {
      userPosts: [], // Liste des posts de l'utilisateur connecté
      user: {}, // Données complètes de l'utilisateur
      isLoading: true, // Pour afficher un chargement conditionnel
    };
  },

  // 🚀 Fonction exécutée automatiquement au montage du composant
  async mounted() {
    try {
      this.isLoading = true;

      // 🔐 Récupération du token d'accès depuis le stockage
      const access_token = JSON.parse(sessionStorage.getItem("access_token"));

      // 👤 Récupération des infos de l'utilisateur connecté
      const response = await fetch("http://localhost:8000/api/user", {
        headers: {
          Authorization: `${access_token.token_type} ${access_token.access_token}`,
          Accept: "application/json",
        },
      });
      const user_data = await response.json();

      // 📥 Récupération des données complètes (posts, bio...) à partir de l'ID utilisateur
      const user_response = await fetch(
        `http://localhost:8000/api/User/${user_data.id}`
      );
      this.user = await user_response.json();

      // 🔄 Pour chaque post, on ajoute l'auteur (user) dans le post
      for (let i = 0; i < this.user.post.length; i++) {
        this.user.post[i].user = {
          name: this.user.name,
        };
      }

      // 📌 Assignation finale des posts de l'utilisateur
      this.userPosts = this.user.post;
      this.isLoading = false;
    } catch (error) {
      console.error("Error: ", error);
    }
  },

  // 🔧 Partie Composition API utilisée pour navigation et actions
  setup() {
    const router = useRouter(); // Utilisé pour redirection

    // 🔁 Redirige vers la page de modification de profil
    const editProfile = (id) => {
      router.push(`/modif-profil/${id}`);
    };

    // ✏️ Action pour modifier un post (à personnaliser selon la logique métier)
    function editPost(post) {
      console.log("Modification du post:", post);
      // 👉 Ajouter logique de navigation vers une page ou modal de modification
    }

    // ❌ Action pour supprimer un post (localement pour l'instant)
    function deletePost(post) {
      console.log("Suppression du post:", post);
      // ⚠️ Attention : ici, ça ne supprime que dans l'affichage local
      // Pour supprimer dans la BDD, il faut appeler l'API
      userPosts.value = userPosts.value.filter((p) => p !== post);
    }

    // 💾 On retourne les fonctions pour les utiliser dans le template
    return { editProfile, editPost, deletePost };
  },
};
</script>

<style scoped>
/* Styles spécifiques à Profil.vue */
</style>

<!-- Ce composant :
    Récupère les informations de l'utilisateur connecté
    Charge ses posts et les prépare pour l'affichage
    Fournit les actions pour éditer et supprimer un post
    Permet d’accéder à la page de modification du profil -->
