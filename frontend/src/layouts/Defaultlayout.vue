<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { onMounted } from "vue";
import { useUserStore } from "src/stores/useUserStore";

const userStore = useUserStore()

onMounted(() => {
  userStore.loadUserFromLocalStorage()
})

</script>
