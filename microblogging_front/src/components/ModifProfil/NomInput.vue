<template>
  <div class="mb-6">
    <label for="name" class="block text-sm font-medium text-gray-700"
      >Nom</label
    >
    <input
      id="name"
      :value="modelValue"
      @input="updateValue"
      type="text"
      placeholder="Votre nom"
      class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
      required
    />
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      // Utilisé avec v-model dans le parent (ex : v-model="form.name")
      type: String,
      required: true,
    },
  },
  methods: {
    updateValue(event) {
      // 🔁 Mise à jour du modèle parent via l'événement personnalisé
      this.$emit("update:modelValue", event.target.value);
    },
  },
};
</script>

<style scoped>
/* 🎨 Styles spécifiques au champ du nom (tu peux en ajouter ici si besoin) */
</style>

<!-- Ce composant permet :
    une saisie propre et réutilisable d’un champ de type texte (nom, email, etc.)
    une liaison avec le parent grâce à v-model
    une organisation plus claire de tes formulaires Vue -->
