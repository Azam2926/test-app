<template>
  <div class="bg-blue-500 flex items-center justify-center text-center h-auto min-h-[8rem] font-bold text-md sm:text-xl lg:text-2xl text-white shadow-lg rounded-t p-2">
    <Loader v-if="loading"/>
    <p v-else>{{ question.content }}</p>
  </div>
</template>

<script>
import Loader from './Loader.vue'
export default {
  name: 'Question',
  components: { Loader },
  props: {
    question: Object,
    loading: Boolean
  },
}
</script>

<style scoped>

</style>