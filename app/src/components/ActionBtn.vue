<template>
  <button class="bg-gray-800 hover:bg-opacity-50 hover:bg-gray-700 font-bold py-2 sm:px-2 shadow-lg "
          :class="[{ 'cursor-not-allowed': disabled }, roundedClass]"
          :disabled="disabled"
          @click="displayQuestion"
  >
    <slot/>
  </button>
</template>

<script>
export default {
  name: 'ActionBtn',
  props: {
    disabled: Boolean,
    roundedClass: String,
  },

  methods: {
    displayQuestion () {
      this.$emit('displayQuestion')
    },
  },
}
</script>

<style scoped>

</style>