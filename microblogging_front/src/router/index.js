// src/router/index.js
import { createRouter, createWebHistory } from "vue-router";

// Ici, tu pourras ajouter toutes tes vues
import HomePMC from "@/views/HomePMC.vue";

const routes = [
  { path: "/", component: HomePMC },
  // Tu pourras ajouter : Connexion, Profil, etc.
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
