<template>
  <div
      class="min-h-[6rem] h-auto
      bg-gradient-to-r hover:from-green-300 hover:to-green-400
      flex items-center
      shadow-lg rounded
      p-2"
      @click="takeAnswer"
      :class="{'from-green-400 to-green-300 hover:from-green-300 hover:to-green-400':answer.isSelected}"
  >
    {{ answer.content }}
  </div>
</template>

<script>
export default {
  name: 'Answer',
  props: {
    answer: {
      type: Object,
      required: true,
    },
  },

  methods: {
    takeAnswer() {
      this.$emit('takeAnswer', this.answer)
    },
  },
}
</script>