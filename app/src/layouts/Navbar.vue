<template>
  <nav class="h-10 sm:h-16 md:h-20
              fixed top-0 inset-x-0 z-50
              text-white bg-gray-800 uppercase font-medium
              flex justify-evenly items-center shadow-lg"
  >
    <router-link to="/" class="hover:underline">Home</router-link>
    <router-link to="/tests" class="hover:underline">Tests</router-link>
    <a href="javascript:void(0)" @click="logout" title="Click to logout">({{ user.username }})</a>
  </nav>
</template>

<script>
import authService from "../service/auth.service";
export default {
  name: 'Navbar',
  props: {
    user: Object | null
  },
  methods: {
    logout: () => {
      authService.logout()
    }
  }
}

</script>