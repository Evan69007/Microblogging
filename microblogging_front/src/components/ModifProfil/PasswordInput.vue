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
      // Renommer la prop en modelValue pour l'utiliser avec v-model
      type: String,
      required: true,
    },
  },
  methods: {
    updateValue(event) {
      this.$emit("update:modelValue", event.target.value); // Émettre l'événement update:modelValue
    },
  },
};
</script>

<style scoped>
/* Styles spécifiques au champ du mot de passe */
</style>
