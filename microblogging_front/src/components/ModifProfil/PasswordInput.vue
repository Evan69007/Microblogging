<template>
  <div class="mb-6">
    <label for="password" class="block text-sm font-medium text-gray-700"
      >Mot de passe</label
    >
    <input
      id="password"
      :value="modelValue"
      @input="updateValue"
      type="password"
      placeholder="Nouveau mot de passe"
      class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
    />
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      // Permet la liaison avec v-model dans le composant parent
      type: String,
      required: true,
    },
  },
  methods: {
    updateValue(event) {
      // 🔁 Envoie la nouvelle valeur au parent via l’événement v-model
      this.$emit("update:modelValue", event.target.value);
    },
  },
};
</script>

<style scoped>
/* 🎨 Styles spécifiques au champ du mot de passe */
</style>
<!--  -->
