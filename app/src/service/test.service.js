import httpClient from './http.service'

const testService = {
  get () {
    return httpClient.get('question?expand=questionAnswers')
  },
  submitAnswers (answers) {
    return httpClient.post('question/check-answers', answers)
  },
  loadingQuestion: {
    id: -1,
    content: 'Loading ...',
    questionAnswers: [
      {
        id: -1,
        content: 'Loading ...',
      },
      {
        id: -1,
        content: 'Loading ...',
      },
      {
        id: -1,
        content: 'Loading ...',
      },
      {
        id: -1,
        content: 'Loading ...',
      },
    ],
  },
}

export default testService
