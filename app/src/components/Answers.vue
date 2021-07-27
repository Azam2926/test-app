<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 m-2 sm:m-4">
    <Answer
        :loading="loading"
        v-for="answer in answers"
        :key="answer.id"
        @takeAnswer="takeAnswer"
        :answer="answer"
    />
  </div>
</template>

<script>
import Answer from "./Answer.vue";

export default {
  name: "Answers",
  components: {Answer},
  props: {
    answers: {
      type: Object,
      required: true,
    },
    loading: Boolean
  },

  methods: {
    takeAnswer(answer) {
      const answers = this.answers.map((item) => {
        item.isSelected = item.id === answer.id;

        return item;
      });
      this.$emit("takeAnswer", answers, answer);
    },
  },
};
</script>