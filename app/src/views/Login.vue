<template>
  <div class="form-wrapper shadow-lg">
    <h3 class="mb-4">Login</h3>
    <form @submit.prevent="login" action="">
      <span v-if="loading" class="loader">loading</span>
      <div v-else-if="errors" class="errors">
        <p v-for="(error, field) in errors" :key="field">
          {{ error[0] }}
        </p>
      </div>
      <input type="text" v-model="form.username" placeholder="Your username"><br>
      <input type="password" v-model="form.password" placeholder="Your password"><br>
      <div class="flex justify-between items-center">
        <button class="btn-login rounded">
          <span v-if="loading">Loading ...</span>
          <span v-else>Login</span>
        </button>
        <router-link to="/register" class="link hover:text-blue-500 text-md">Click here to register</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import authService from "../service/auth.service";

export default {
  name: "Login",
  data() {
    return {
      form: {
        username: '',
        password: ''
      },
      errors: null,
      loading: false
    }
  },
  methods: {
    async login() {
      this.setLoading(true)

      const {success, errors} = await authService.login(this.form)
      if (success)
        await this.$router.push({name: 'home'})
      else
        this.errors = errors

      this.setLoading(false)
    },

    setLoading(bool) {
      this.loading = bool
    }
  }
}
</script>