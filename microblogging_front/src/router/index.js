// src/router/index.js

// 📦 Importation des fonctions du Vue Router
import { createRouter, createWebHistory } from "vue-router";

// 📁 Importation de toutes les vues de ton application
import HomePMC from "@/views/HomePMC.vue"; // Page d’accueil
import Connexion from "@/views/Connexion.vue"; // Connexion utilisateur
import Profil from "@/views/Profil.vue"; // Profil utilisateur
import AjoutPost from "@/views/AjoutPost.vue"; // Création d’un post
import CreationCompte from "@/views/CreationCompte.vue"; // Création de compte
import ModifPost from "@/views/ModifPost.vue"; // Modifier un post existant
import ModifProfil from "@/views/ModifProfil.vue"; // Modifier son profil

// 🧭 Déclaration des routes
const routes = [
  {
    path: "/", // URL racine
    component: HomePMC, // Page d’accueil
  },
  {
    path: "/connexion", // Page de connexion
    component: Connexion,
  },
  {
    path: "/profil", // Page de profil
    component: Profil,
  },
  {
    path: "/post", // Page de création d’un post
    component: AjoutPost,
  },
  {
    path: "/creation-compte", // Page d’inscription
    component: CreationCompte,
  },
  {
    path: "/modif-post/:id", // Page pour modifier un post (paramètre dynamique :id)
    name: "ModifPost",
    component: ModifPost,
    props: true, // Permet de passer l'id comme prop au composant
  },
  {
    path: "/modif-profil/:id", // Page pour modifier la bio/profil
    name: "ModifProfil",
    component: ModifProfil,
    props: true,
  },
];

// 🛠️ Création de l’instance du routeur
const router = createRouter({
  history: createWebHistory(), // Utilise l'historique HTML5 (pas de # dans l’URL)
  routes, // Liste des routes définies ci-dessus
});

// 🚀 Export du routeur pour pouvoir l’utiliser dans main.js
export default router;

/* Ce fichier configure le système de navigation de ton application Vue.js.

Il permet de :
    Relier chaque URL à un composant Vue
    Gérer les routes dynamiques avec des paramètres (/modif-post/:id)
    Naviguer dans l'application sans recharger la page */
