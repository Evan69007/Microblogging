<template>
  <div class="mb-6">
    <label for="email" class="block text-sm font-medium text-gray-700"
      >E-mail</label
    >
    <input
      id="email"
      :value="modelValue"
      @input="updateValue"
      type="email"
      placeholder="Votre email"
      class="w-full p-3 border border-gray-300 rounded-md mt-2 text-black"
      required
    />
  </div>
</template>

<script>
export default {
  props: {
    // 🔁 Utilisé avec v-model dans le composant parent
    modelValue: {
      type: String,
      required: true,
    },
  },
  methods: {
    // 📤 Méthode appelée lorsqu'on saisit quelque chose dans le champ
    updateValue(event) {
      // Émet un événement personnalisé pour mettre à jour la valeur dans le parent
      this.$emit("update:modelValue", event.target.value);
    },
  },
};
</script>
<!-- Ce script est la base d’un composant d’entrée réutilisable, qui fonctionne avec v-model. -->
