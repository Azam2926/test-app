<template>
  <div v-if="result.show"
       class="min-h-[inherit] font-sans text-white py-4 sm:px-4 md:px-4 font-bold text-2xl flex flex-col space-y-16 text-center justify-center items-center">
    <p>{{ result.score }} from {{ question_length }} questions</p>
    <a
        class="text-lg cursor-pointer bg-gray-800 hover:bg-opacity-50 mx-auto w-10/12 md:w-1/4 text-center text-gray-200 hover:bg-gray-700 z-50 font-bold py-4 px-4 shadow-lg rounded"
        @click="this.$router.go()"
    >
      Replay test
    </a>
  </div>

  <div v-else>
    <p v-show="!loading" class="text-center mt-4 pt-4 text-gray-800 text-2xl">{{ footer }}</p>
    <div
        class="flex justify-center items-center text-white pt-4 px-2 sm:px-4 md:px-4"
        :class="{'px-8 py-2': loading}"
    >
      <action-btn v-show="!loading" :disabled="disabledPrev" @displayQuestion="currentIndex--" roundedClass="rounded-l">
        <app-svg d="M15 19l-7-7 7-7"/>
      </action-btn>

      <div class="flex flex-col bg-purple-800 bg-opacity-50 shadow-lg rounded !w-[1050px] h-auto">
        <Question :loading="loading" :question="currentQuestion"/>
        <Answers :loading="loading" :answers="currentQuestion.questionAnswers" @takeAnswer="takeAnswers"/>
      </div>

      <action-btn v-show="!loading" :disabled="disabledNext" @displayQuestion="currentIndex++" roundedClass="rounded-r">
        <app-svg d="M9 5l7 7-7 7"/>
      </action-btn>
    </div>
    <div class="flex pb-4">
      <button
          class="text-lg mb-4 bg-gray-800 hover:bg-opacity-50 inline-flex justify-center mx-auto w-1/2 md:w-1/4 text-gray-200 hover:bg-gray-700 z-50 font-bold py-4 px-4 shadow-lg rounded-b"
          :class="{ hidden: hiddenSubmit }"
          @click="submitAnswers"
      >
        Check answers
      </button>
    </div>
  </div>

</template>

<script>
import testService from '../service/test.service'
import Question from './Question.vue'
import Answers from './Answers.vue'
import ActionBtn from './ActionBtn.vue'
import AppSvg from './AppSvg.vue'

export default {
  name: 'Test',
  components: { AppSvg, Question, ActionBtn, Answers },
  props: {
    slug: String,
  },
  data () {
    return {
      error: false,
      loading: false,
      questions: [],
      currentIndex: 0,
      reachedEnd: false,
      answers: [],
      result: {
        score: 'Loading...',
        show: false,
      },
    }
  },
  async created () {
    this.loading = true
    try {
      const res = await testService.getQuestions(this.slug)
      this.questions = res.data
    } catch (e) {
      this.error = true
    }
    this.loading = false
  },
  methods: {
    async submitAnswers () {
      this.loading = true

      try {
        const res = await testService.submitAnswers(this.answers)
        this.result = {
          score: res.data.score,
          show: true,
        }
      } catch (e) {
        console.log(e)
      }
      this.loading = false

    },
    takeAnswers (answers, selectedAnswer) {
      this.questions[this.currentIndex].questionAnswers = answers

      const answeredQuestionIndex = this.answers.findIndex(obj => obj.question_id === this.currentQuestion.id)

      if (answeredQuestionIndex !== -1)
        this.answers[answeredQuestionIndex].answer_id = selectedAnswer.id
      else
        this.answers.push({
          question_id: this.currentQuestion.id,
          answer_id: selectedAnswer.id,
        })

      setTimeout(() => {
        if (this.currentIndex !== this.question_length - 1)
          this.currentIndex++
      }, 700)
    },
  },
  computed: {
    currentQuestion () {
      if (this.error)
        return testService.notFound

      return this.questions[this.currentIndex] ?? testService.loading
    },
    disabledPrev () {
      return this.currentIndex === 0
    },
    disabledNext () {
      return this.currentIndex === this.question_length - 1
    },
    hiddenSubmit () {
      if (this.reachedEnd)
        return false

      if (this.currentIndex !== this.question_length - 1)
        return true

      this.reachedEnd = true

      return false
    },
    question_length () {
      return this.questions.length
    },
    footer () {
      return (this.currentIndex + 1) + '/' + (this.question_length)
    },
  },
}
</script>