// src/router/index.js

// Import des fonctions du Vue Router
import { createRouter, createWebHistory } from "vue-router";

// Import de ta vue principale (page d’accueil)
import HomePMC from "@/views/HomePMC.vue";
import Connexion from "@/views/Connexion.vue";
import Profil from "@/views/Profil.vue";
import AjoutPost from "../views/AjoutPost.vue";

// Déclaration des routes
const routes = [
  {
    path: "/", // URL de la page
    component: HomePMC, // Composant à afficher (la vue)
  },
  { path: "/connexion", component: Connexion },
  { path: "/profil", component: Profil },
  { path: "/post", component: AjoutPost },
  // Tu pourras ajouter d'autres routes ici, par exemple :
  // { path: "/connexion", component: Connexion },
  // { path: "/profil", component: Profil },
];

// Création de l'instance du routeur avec l'historique HTML5 (sans # dans l’URL)
const router = createRouter({
  history: createWebHistory(), // mode 'history' (chemins normaux)
  routes, // liste des routes définies
});

// Export du routeur pour l’utiliser dans main.js
export default router;
