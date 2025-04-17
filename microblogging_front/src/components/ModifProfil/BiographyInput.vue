<template>
  <div class="mb-6">
    <label for="biography" class="block text-sm font-medium text-gray-700"
      >Biographie</label
    >
    <textarea
      id="biography"
      :value="modelValue"
      @input="updateBiography"
      placeholder="Votre biographie"
      class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
      rows="4"
    ></textarea>
  </div>
</template>

<script>
export default {
  props: {
    // 🔁 `modelValue` est la convention Vue 3 pour utiliser `v-model` avec des composants personnalisés
    modelValue: {
      type: String,
      required: true,
    },
  },
  methods: {
    // 📤 Envoie la nouvelle valeur saisie vers le parent via `v-model`
    updateBiography(event) {
      this.$emit("update:modelValue", event.target.value);
    },
  },
};
</script>

<style scoped>
/* 🎨 Styles propres au composant */
</style>
<!-- Ce composant encapsule un champ textarea pour saisir une biographie utilisateur, avec les avantages suivants :
    Il peut être réutilisé partout où on veut un champ biographie.
    Il est contrôlé avec v-model dans un composant parent (ex. ModifProfil.vue ou CreationCompte.vue).
    Il respecte la syntaxe de liaison descendante/montante (props + emit), propre à Vue 3. -->
