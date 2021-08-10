<template>
  <spinner v-if="loading"/>
  <div v-else class="p-2">
    <ul class="space-y-4 pt-4 md:flex md:flex-col md:justify-center md:text-center text-white text-xl">
      <li v-for="(test, index) in tests" :key="index">
        <router-link :to="'/test/'+test.slug" class="hover:underline hover:text-gray-700">
          {{ test.title }} - {{ test.content }}
        </router-link>
      </li>
    </ul>
  </div>

</template>

<script>
import testService from '../service/test.service'
import Spinner from '../components/Spinner.vue'

export default {
  components: { Spinner },
  data () {
    return {
      tests: [],
      loading: true,
    }
  },
  created: async function () {
    const { status, data } = await testService.getTests()
    if (status === 200)
      this.tests = data
    else
      this.tests = testService.testNotFound

    this.loading = false
  },
}
</script>