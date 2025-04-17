// 📦 Import de la fonction pour créer une application Vue
import { createApp } from "vue";

// 🧩 Composant racine de l'application (point d'entrée)
import App from "./App.vue";

// 🚦 Importation du système de routing (gestion des pages/navigation)
import router from "./router";

// 🎨 Import des styles globaux (fichier CSS personnalisé ou Tailwind)
import "./assets/style.css";

// 🏗️ Création de l'application Vue à partir du composant App
const app = createApp(App);

// 🔌 Intégration du routeur dans l'application (nécessaire pour <router-view>)
app.use(router);

// 🚀 Montage de l'app Vue dans l'élément HTML ayant l'id 'app' (index.html)
app.mount("#app");

/* Ce fichier initialise ton application Vue 3 :
    Il crée l'application (createApp),
    Y ajoute le routeur pour la navigation entre pages,
    Et monte ton app dans le DOM, dans l'élément <div id="app"></div> de index.html.

C’est le point d’entrée principal de toute application Vue. */
