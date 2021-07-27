<template>
  <div
      class="w-full min-h-[5rem] h-auto
      bg-gradient-to-r hover:bg-gradient-to-l
      flex items-center
      font-bold text-md sm:text-xl lg:text-2xl text-white
      shadow-lg rounded
      cursor-pointer
      p-2"
      @click="takeAnswer"
      :class="{'from-green-500 to-green-400 ':answer.isSelected, 'animate-pulse' : loading}"
  >
    <Loader v-if="loading"/>
    <p v-else>{{ answer.content }}</p>
  </div>
</template>

<script>
import Loader from './Loader.vue'

export default {
  name: 'Answer',
  components:{Loader},
  props: {
    answer: {
      type: Object,
      required: true,
    },
    loading:Boolean
  },

  methods: {
    takeAnswer () {
      this.$emit('takeAnswer', this.answer)
    },
  },
}
</script>