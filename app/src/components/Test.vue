<template>

  <div v-if="result.show" class="min-h-[inherit] font-sans text-white py-4 sm:px-4 md:px-4 font-bold text-2xl flex justify-center items-center">
    {{ result.score }} from {{ question_length }} questions
  </div>

  <div v-else>
    <div class="font-sans flex justify-center items-center text-white pt-10 sm:px-4 md:px-4">
      <action-btn :disabled="disabledPrev" @displayQuestion="currentIndex--" roundedClass="rounded-l">
        <app-svg d="M15 19l-7-7 7-7"/>
      </action-btn>

      <div class="flex flex-col bg-purple-800 bg-opacity-50 shadow-lg rounded !w-[1050px] h-auto">
        <Question :question="currentQuestion"/>
        <Answers :answers="currentQuestion.questionAnswers" @takeAnswer="takeAnswers"/>
      </div>

      <action-btn :disabled="disabledNext" @displayQuestion="currentIndex++" roundedClass="rounded-r">
        <app-svg d="M9 5l7 7-7 7"/>
      </action-btn>
    </div>
    <div class="flex">
      <button
          class="bg-gray-800 hover:bg-opacity-50 mx-auto w-1/6 text-gray-200 hover:bg-gray-700 z-50 font-bold py-4 px-4 shadow-lg rounded-b"
          :class="{ hidden: hiddenSubmit }"
          @click="submitAnswers"
      >
        Submit
      </button>
    </div>
    <p class="text-center mt-4 text-gray-800 text-2xl">{{ footer }}</p>
  </div>

</template>

<script>
import testService from '../service/test.service'
import Question from './Question.vue'
import Answers from './Answers.vue'
import ActionBtn from './ActionBtn.vue'
import AppSvg from "./AppSvg.vue";

export default {
  name: 'Test',
  components: {AppSvg, Question, ActionBtn, Answers},
  data() {
    return {
      questions: [],
      currentIndex: 0,
      reachedEnd: false,
      answers: [],
      result: {
        score: 'Loading...',
        show: false
      },
    }
  },
  async created() {
    try {
      const res = await testService.get()
      this.questions = res.data
    } catch (e) {
      console.log(e)
    }
  },
  methods: {
    async submitAnswers() {
      try {
        const res = await testService.submitAnswers(this.answers)
        this.result = {
          score: res.data.score,
          show: true
        }
      } catch (e) {
        console.log(e)
      }
    },
    takeAnswers(answers, selectedAnswer) {
      this.questions[this.currentIndex].questionAnswers = answers

      const answeredQuestionIndex = this.answers.findIndex(obj => obj.question_id === this.currentQuestion.id)

      if (answeredQuestionIndex !== -1)
        this.answers[answeredQuestionIndex].answer_id = selectedAnswer.id
      else
        this.answers.push({
          question_id: this.currentQuestion.id,
          answer_id: selectedAnswer.id,
        })
    },
  },
  computed: {
    currentQuestion() {
      return this.questions[this.currentIndex] ?? testService.loadingQuestion
    },
    disabledPrev() {
      return this.currentIndex === 0
    },
    disabledNext() {
      return this.currentIndex === this.question_length - 1
    },
    hiddenSubmit() {
      if (this.reachedEnd)
        return false;

      if (this.currentIndex !== this.question_length - 1)
        return true

      this.reachedEnd = true;

      return false
    },
    question_length() {
      return this.questions.length
    },
    footer() {
      return (this.currentIndex + 1) + '/' + (this.question_length)
    }
  },
}
</script>