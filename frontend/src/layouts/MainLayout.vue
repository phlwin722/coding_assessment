<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title> Quasar App </q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered>
      <q-list>
        <q-item-label header> Sidebar Links </q-item-label>

        <EssentialLink
          v-for="link in linksList"
          :key="link.title"
          v-bind="link"
          @click="handleLinkClick(link)"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref } from "vue";
import { useQuasar } from "quasar";
import { useUserStore } from "src/stores/useUserStore.js";
import { useRouter } from "vue-router";
import EssentialLink from "components/EssentialLink.vue";

const $q = useQuasar();
const userStore = useUserStore();
const router = useRouter();

const leftDrawerOpen = ref(false);

const linksList = [
  { title: "Products", icon: "inventory", to: "/admin/product" },
  { title: "Videos", icon: "video_library", to: "/admin/videos" },
  { title: "Logout", icon: "logout" },
];

function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value;
}

function handleLinkClick(link) {
  if (link.title === "Logout") {
    userStore.clearUser();
    router.push("/login");
  } else if (link.to) {
    router.push(link.to);
  }
}
</script>
