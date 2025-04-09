<template>
  <div class="flex flex-col min-h-screen bg-gray-800 text-white font-sans">
    <div class="flex flex-1">
      <!-- Sidebar filtres -->
      <!-- <FiltreSideBar /> -->

      <!-- Contenu principal -->
      <main class="flex-1 p-6 overflow-y-auto">
        <h2
          class="text-center text-2xl font-bold tracking-widest mb-6 text-gray-100"
        >
          DERNIERS POSTS
        </h2>

        <!-- Liste des posts -->
        <PostList :posts="posts" />
      </main>
    </div>
  </div>
</template>

<script setup>
//import FiltreSideBar from "@/components/FiltreSideBar.vue";
import PostList from "@/components/Posts/PostList.vue";

const posts = [
  {
    id: 1,
    titre: "Zoom sur une fonction PHP ou JS",
    contenu:
      "🔥 array_filter() en PHP, c’est la magie pour nettoyer des tableaux en un clin d’œil. Bonus : tu peux l’utiliser avec une fonction anonyme.",
    auteur: "Laura",
    date: "08/04/2025",
    tags: ["#astuces", "#languages"],
    likes: 4,
    comments: 2,
    couleur: "border-teal-400",
  },
  {
    id: 2,
    titre: "Question technique",
    contenu:
      '"Vous utilisez plutôt v-model ou des props/emit dans Vue 3 pour les formulaires ? Curieuse de vos habitudes ! #DevTalk"',
    auteur: "Laura",
    date: "08/04/2025",
    tags: ["#astuces", "#languages"],
    likes: 4,
    comments: 1,
    couleur: "border-yellow-400",
  },
  {
    id: 3,
    titre: "Réflexion perso",
    contenu:
      "Aujourd’hui j’ai compris que git stash me sauve la vie quand je bricole avant un pull. L’outil magique du chaos 🥰",
    auteur: "Laura",
    date: "08/04/2025",
    tags: ["#astuces", "#languages"],
    likes: 8,
    comments: 3,
    couleur: "border-rose-400",
  },
  {
    id: 4,
    titre: "Le tip rapide du jour",
    contenu:
      "💡 VS Code : Ctrl + Shift + L => sélection de toutes les occurrences !",
    auteur: "Laura",
    date: "08/04/2025",
    tags: ["#astuces", "#languages"],
    likes: 5,
    comments: 0,
    couleur: "border-orange-400",
  },
  {
    id: 5,
    titre: "Le tip rapide du jour",
    contenu:
      "💡 VS Code : Ctrl + Shift + L => sélection de toutes les occurrences !",
    auteur: "Laura",
    date: "08/04/2025",
    tags: ["#astuces", "#languages"],
    likes: 5,
    comments: 0,
    couleur: "border-orange-400",
  },
  {
    id: 6,
    titre: "Le tip rapide du jour",
    contenu:
      "💡 VS Code : Ctrl + Shift + L => sélection de toutes les occurrences !",
    auteur: "Laura",
    date: "08/04/2025",
    tags: ["#astuces", "#languages"],
    likes: 5,
    comments: 0,
    couleur: "border-orange-400",
  },
];
</script>

<style scoped></style>
