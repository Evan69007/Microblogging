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
    modelValue: {
      // Renommer la prop en modelValue pour l'utiliser avec v-model
      type: String,
      required: true,
    },
  },
  methods: {
    updateBiography(event) {
      this.$emit("update:modelValue", event.target.value); // Émettre l'événement update:modelValue
    },
  },
};
</script>

<style scoped>
/* Styles spécifiques pour le champ de biographie */
</style>
