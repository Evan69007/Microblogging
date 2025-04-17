// 📦 Importation de la librairie Axios pour faire des requêtes HTTP
import axios from "axios";

// 🎯 URL de base de ton API Laravel
const API_URL = "http://localhost:8000/api";

// 🔧 Création d'une instance Axios avec configuration par défaut
const api = axios.create({
  baseURL: API_URL,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

// 🔐 Si un token est présent dans sessionStorage, on l'ajoute aux headers
const token = JSON.parse(sessionStorage.getItem("access_token"));
if (token?.access_token) {
  api.defaults.headers.common["Authorization"] = `Bearer ${token.access_token}`;
}

export default {
  // 📥 Récupérer les infos de l'utilisateur connecté
  async getUser() {
    const response = await api.get("/user");
    return response.data;
  },

  // 📚 Récupérer tous les posts
  async getPosts() {
    const response = await api.get("/posts");
    return response.data;
  },

  // 🔍 Récupérer un seul post par ID
  async getPost(id) {
    const response = await api.get(`/posts/${id}`);
    return response.data;
  },

  // ➕ Créer un nouveau post
  async createPost(postData) {
    const response = await api.post("/posts", postData);
    return response.data;
  },

  // ✏️ Modifier un post existant
  async updatePost(id, postData) {
    const response = await api.put(`/posts/${id}`, postData);
    return response.data;
  },

  // 🗑️ Supprimer un post
  async deletePost(id) {
    try {
      const response = await api.delete(`/posts/${id}`);
      if (response.data.message === "Utilisateur non connecté") {
        return "Erreur";
      } else {
        return response.data;
      }
    } catch (error) {
      return error;
    }
  },

  // ❤️ Ajouter un like à un post
  async addLike(id_post, id_user) {
    const response = await api.post("/likes", {
      user_id: id_user,
      post_id: id_post,
    });
    return response.data;
  },

  // 💔 Supprimer un like (via l’ID du like)
  async removeLike(id) {
    const response = await api.delete(`/likes/${id}`);
    return response.data;
  },
};

/* Ce fichier centralise toutes les requêtes API de ton app Vue.js vers ton back Laravel :
    Tu n’as qu’un seul endroit où gérer l’URL de l’API
    Tu facilites la maintenance de ton code
    Tu peux ajouter facilement de nouvelles méthodes (getComments(), updateProfile(), etc.)

 */
