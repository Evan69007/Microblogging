<template>
  <div>
    <h3 class="text-xl text-gray-300 mb-4">Choisissez des tags</h3>
    <div class="grid grid-cols-3 gap-4">
      <label
        v-for="(tag, index) in availableTags"
        :key="index"
        class="flex items-center space-x-2"
      >
        <input
          type="checkbox"
          :value="tag"
          v-model="selectedTags"
          class="text-teal-400"
        />
        <span class="text-gray-300">{{ tag }}</span>
      </label>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

// Liste des tags disponibles
const availableTags = ref([
  "Tech",
  "JavaScript",
  "Vue.js",
  "PHP",
  "CSS",
  "Backend",
  "Frontend",
  "Web Design",
]);

// Liste des tags sélectionnés par l'utilisateur
const selectedTags = ref([]);

// Exposer les tags sélectionnés pour utilisation dans le composant parent
defineExpose({
  selectedTags,
});
</script>

<style scoped>
/* Styles pour la checklist de tags */
.grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}
</style>
