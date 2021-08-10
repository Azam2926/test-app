<template>
  <Navbar :user="user"/>
  <main class="mt-[2.5rem] sm:mt-[4rem] md:mt-[5rem] bg-gradient-to-r from-[#21d1ee] to-[#0ea6e9] min-h-[calc(100vh-2.5rem)] sm:min-h-[calc(100vh-4rem)] md:min-h-[calc(100vh-5rem)] font-nunito"
  >
    <router-view/>
  </main>
</template>

<script>
import Navbar from './Navbar.vue'
import authService from "../service/auth.service";
export default {
  name: 'Main',
  components: {Navbar},
  data: () => {
    return {
      user: {}
    }
  },
  async mounted() {
    this.user = await authService.getUser()
  }
}
</script>