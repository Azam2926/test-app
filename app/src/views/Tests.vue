<template>
  <div class="p-2">
    <ul class="space-y-4 pt-4 md:flex md:flex-col md:justify-center md:text-center text-white text-xl">
    <li v-for="(test, index) in tests" :key="index" >
      <router-link :to="'/test/'+test.slug" class="hover:underline hover:text-gray-700">
        {{ test.title }} - {{ test.content }}
      </router-link>
    </li>
  </ul>
  </div>
</template>

<script>
import testService from '../service/test.service'

export default {

  data () {
    return {
      tests: [],
    }
  },
  async created () {
    const { status, data } = await testService.getTests()
    if (status === 200)
      this.tests = data
  },
}
</script>