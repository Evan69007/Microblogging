<template>
	<div v-if="isLoading">
		Chagement en cours...
	</div>
  <div v-else class="bg-gray-800 text-white min-h-screen pt-32 pb-8">
    <!-- Bouton "Modifier Profil" -->
    <div class="absolute top-32 right-16 z-10">
      <button
        @click="editProfile(user.id)"
        class="bg-green-800 text-white py-2 px-6 rounded-md hover:bg-orange-700 transition"
      >
        Modifier Profil
      </button>
    </div>

    <!-- Conteneur en flex pour la biographie et les posts -->
    <div class="flex gap-16 pt-32 px-16 items-stretch">
      <!-- Section Biographie (à gauche) -->
      <div
        class="flex-1 text-center bg-gray-900 p-6 rounded-xl shadow-lg max-h-[700px] sticky top-32"
      >
        <h2 class="text-5xl text-gray-400 mb-4">Biographie</h2>
        <p class="text-7xl text-yellow-300 font-bold">{{ user.name }}</p>
        <p class="text-2xl text-gray-300 mt-4">{{ user.profil__users[0].biographie }}</p>
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
import PostCard from "@/components/Posts/PostCard.vue";
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";


export default {
  components: {
    PostCard,
  },
  data() {
    return {
      userPosts: [],
	  user: {},
	  isLoading: true
    }
  },
  async mounted() {
    try {
		this.isLoading = true
		const access_token = JSON.parse(sessionStorage.getItem('access_token'))
		const response = await fetch("http://localhost:8000/api/user", {
			headers: {
				Authorization: `${access_token.token_type} ${access_token.access_token}`,
				Accept: "application/json"
			}
		})
		const user_data = await response.json()
		const user_response = await fetch(`http://localhost:8000/api/User/${user_data.id}`)
		this.user = await user_response.json()
		this.userPosts = this.user.post
		this.isLoading = false
	}
	catch(error)
	{
		console.error("Error: ", error)
	}
  },
  
  setup()
  {
	// Méthode pour rediriger vers la vue ModifProfil
	const router = useRouter();
	const editProfile = (id) => {
	router.push(`/modif-profil/${id}`); // Rediriger vers la vue ModifProfil
	};

	// Fonction pour éditer un post
	function editPost(post) {
	console.log("Modification du post:", post);
	// Ajoute la logique de modification ici (par exemple, ouvrir un modal ou rediriger vers un formulaire)
	}

	// Fonction pour supprimer un post
	function deletePost(post) {
	console.log("Suppression du post:", post);
	// Ajoute la logique pour supprimer le post (par exemple, le retirer de la liste)
	userPosts.value = userPosts.value.filter((p) => p !== post);
	}

	return {editProfile, editPost, deletePost}
  }
}
		

</script>

<style scoped>
/* Styles spécifiques à Profil.vue */
</style>
