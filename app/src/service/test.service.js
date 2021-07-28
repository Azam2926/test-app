import httpClient from './http.service'

const testService = {
  get: async (slug) => {
    return await httpClient.get('question?expand=questionAnswers&slug=' + slug)
  },
  async submitAnswers (answers) {
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
  }
}

export default testService
