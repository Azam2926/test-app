<template>
  <div class="bg-blue-500 flex items-center justify-center h-auto min-h-[9rem] font-bold text-2xl text-white shadow-lg rounded-t text-gray-200 p-2">
    {{ question.content }}
  </div>
</template>

<script>
export default {
  name: 'Question',
  props: {
    question: Object,
  },
}
</script>

<style scoped>

</style>