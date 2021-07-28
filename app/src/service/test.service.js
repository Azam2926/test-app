import httpClient from './http.service'

const testService = {
  getQuestions: async (slug) => {
    return await httpClient.get('question?expand=questionAnswers&slug=' + slug)
  },
  getTests: async () => {
    return await httpClient.get('test')
  },
  submitAnswers: async (answers) => {
    return await httpClient.post('question/check-answers', answers)
  },

  loading: {
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
  notFound: {
    id: -1,
    content: 'Something went wrong',
    questionAnswers: [
      {
        id: -1,
        content: 'Something went wrong',
      },
      {
        id: -1,
        content: 'Something went wrong',
      },
      {
        id: -1,
        content: 'Something went wrong',
      },
      {
        id: -1,
        content: 'Something went wrong',
      },
    ],
  },
  testNotFound: [
    {
      title: 'Something went wrong',
      content: 'Something went wrong',
    },
  ],
}

export default testService
