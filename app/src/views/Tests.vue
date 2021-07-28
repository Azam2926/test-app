<template>
  <ul class="flex flex-col justify-center items-center space-y-4 pt-4 text-gray-700 text-xl">
    <li v-for="(test, index) in tests" :key="index">
      <router-link :to="'/test/'+test.slug">
        {{ test.title }} - {{ test.content }}
      </router-link>
    </li>
  </ul>
  <router-view/>
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