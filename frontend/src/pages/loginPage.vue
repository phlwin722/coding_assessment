<template>
  <q-layout class="login-layout">
    <q-card class="login-card">
      <q-card-section class="login-page">
        <h2>Login</h2>

        <InputField
          label="Email or Username "
          type="text"
          v-model="email"
          :error="!!formError.username"
          :error-message="formError.username?.[0]"
        >
          <template #prepend>
            <q-icon name="email" />
          </template>
        </InputField>

        <InputField
          label="Password"
          :type="isPwd ? 'password' : 'text'"
          v-model="password"
          :error="!!formError.password"
          :error-message="formError.password?.[0]"
        >
          <template #prepend>
            <q-icon name="lock" />
          </template>

          <template #append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </InputField>

        <div class="flex items-center justify-start q-mt-md">
          <q-checkbox dense v-model="remember" label="Remember Me" />
        </div>

        <q-btn
          color="primary"
          type="button"
          class="q-mt-lg login-btn"
          label="Login"
          @click="handleLogin"
        />
      </q-card-section>
    </q-card>

    <InnerLoading :loading="isLoading" />
  </q-layout>
</template>

<script setup>
import { InputField, InnerLoading } from "components/index.js";
import { ref } from "vue";
import { axios } from "src/boot/axios";
import { $notify } from "src/boot/app";
import { useUserStore } from "src/stores/useUserStore.js";

const password = ref(null);
const email = ref(null);
const formError = ref({});
const remember = ref(false);
const userStore = useUserStore();

const isPwd = ref(true);
const isLoading = ref(false);

const apiUrl = "/auth";

const handleLogin = async (e) => {
  try {
    isLoading.value = true;
    formError.value = {};

    const response = await axios.post(`${apiUrl}/login`, {
      username: email.value,
      password: password.value,
      remember: remember.value,
    });  

    if (response.data.message) {
      const rememberMe = remember.value;
      
      userStore.setUser(response.data.user, rememberMe, response.data.access_token);

      window.location.href = "/admin/product";
    }
  } catch (error) {
    if (error.response && error.response.status === 422) {
      formError.value = error.response.data.errors;
    } else if (error.response && error.response.status === 401) {
      $notify("negative", "error", error.response.data.error);
    }
  } finally {
    isLoading.value = false;
  }
};
</script>

<style lang="scss" scoped>
.login-layout {
  background-color: #f3f4f6;
  height: 100vh; 
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-card {
  width: 400px;
  height: 450px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  background-color: #ffffff;
  text-align: center;
}

.login-btn {
  width: 100%;
}
</style>
