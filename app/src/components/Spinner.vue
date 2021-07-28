<template>
  <div class="flex justify-center items-center p-4">
    <div class="spinner rounded-full ease-linear border-8 border-t-8 border-gray-200 h-10 w-10"></div>
  </div>
</template>

<script>
export default {
  name: 'Spinner',
}
</script>

<style scoped>
.spinner {
  border-top-color: #3498db;
  -webkit-animation: spinner 1.5s linear infinite;
  animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spinner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>