<template>
  <div class="form-wrapper">
    <h3 class="mb-4">Register</h3>
    <form @submit.prevent="register" action="">
      <span v-if="loading" class="loader">loading ..</span>
      <div v-else-if="errors" class="errors">
        <p v-for="(error, field) in errors" :key="field">
          {{ error[0] }}
        </p>
      </div>
      <input type="text" v-model="form.username" placeholder="Your username"><br>
      <input type="password" v-model="form.password" placeholder="Your password"><br>
      <input type="password" v-model="form.password_repeat" placeholder="Repeat password"><br>
      <div class="flex justify-between items-center">

        <button :disabled="loading" class="btn-login rounded">
          <span v-if="loading">Loading ...</span>
          <span v-else>Register</span>
        </button>
        <router-link to="/login" class="link hover:text-blue-500">Click here to login</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import authService from "../service/auth.service";

export default {
  name: "Registration",
  data() {
    return {
      form: {
        username: '',
        password: '',
        password_repeat: ''
      },
      errors: null,
      loading: false
    }
  },
  methods: {
    async register() {
      this.setLoading(true)

      const {success, errors} = await authService.register(this.form)
      if (success)
        this.$router.push({name: 'home'})
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
