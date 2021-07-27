<template>
  <div class="bg-blue-500 min-h-screen flex justify-center items-center text-md">
    <router-view/>
  </div>
</template>

<style >
#auth-layout {
  padding: 50px;

}

.form-wrapper {
  background-color: white;
  padding: 20px;
  width: 300px;
  margin: 0 auto;
  border-radius: 4px;
  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);

}

h3 {
  text-align: center;
  margin-bottom: 30px;
}

.loader {
  position: absolute;
  right: 2%;
  top: 0;
}

input {
  display: block;
  width: 100%;
  border: 2px solid #e6e6e6;
  padding: 6px 12px !important;
  transition: all 0.3s;
  border-radius: 0.25rem;
}

input:focus {
  outline: 0;
  border-color: #4fb2c1;
}

.btn-login {
  outline: 0;
  cursor: pointer;
  border: 1px solid #4fb2c1;
  background-color: #4fb2c1;
  color: white;
  padding: 6px 12px;
  transition: all 0.3s;

}

.btn-login:hover {
  background-color: #4fb2c1;
}

.disabled {
  border: 0;
  background-color: #8ec6ce;
}

.errors {
  margin-bottom: 15px;
  padding: 10px 15px;
  color: #fff;
  background-color: #ff6969;
  font-size: 16px;

}

p {
  margin: 0;
}

.link {
  font-size: 80%;
  float: right;
}
</style>