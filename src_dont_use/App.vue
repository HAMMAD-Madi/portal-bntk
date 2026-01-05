<!-- <template>
  <v-app>
    <v-app-bar color="black" density="compact">
      <template v-slot:prepend>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </template>
      <v-app-bar-title>BNTK</v-app-bar-title>
      <v-btn v-if="!auth.user" variant="text" :to="'/login'">
        Login
      </v-btn>
      <v-btn v-else @click="logout()" variant="text">
        Uitloggen
      </v-btn>
      <template v-slot:append>
        <v-btn icon="fa-ellipsis-vertical"></v-btn>
      </template>
    </v-app-bar>

    <v-navigation-drawer
      class="bg-grey-darken-4"
      theme="dark"
      v-model="drawer"
      permanent
    >
      <div class="pa-5 d-flex justify-center">
        <!-/- <v-img :width="200" :src="`${baseurl}/logo.png`"></v-img> -;->
      </div>
      <tree-menu :menu-items="menuItems" />
      <template v-slot:append>
        <div class="pa-2">
          <v-btn :to="'/login'" block v-if="!auth.user">
            Login
          </v-btn>
          <v-btn @click="logout()" block v-else>
            Uitloggen
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-main class="fill-height">
      <router-view class="pa-6"></router-view>
    </v-main>
    <GlobalSnackbar />
  </v-app>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from './stores/auth'
import { useDisplay } from 'vuetify'
import TreeMenu from './components/TreeMenu.vue'
import { menuItems } from './menu'

const baseurl = import.meta.env.VITE_BASE_API_URL
const { mobile } = useDisplay()
const auth = useAuthStore()
const drawer = ref()

function logout() {
  auth.logout()
}

window.addEventListener('resize', function () {
  drawer.value = !mobile.value ? true : false
}, true)

onMounted(() => {
  drawer.value = !mobile.value ? true : false
})
</script>

<style scoped>
html, body, #app {
  height: 100%;
}
.fill-height {
  min-height: 100vh;
}
</style> -->


<template>
  <component :is="layout">
    <router-view class="pa-6"></router-view>
  </component>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

import DefaultLayout from './layouts/Default.vue'
import GuestLayout from './layouts/Guest.vue'

const route = useRoute()
const layouts = {
  default: DefaultLayout,
  guest: GuestLayout,
}

const layout = computed(() => {
  return layouts[route.meta.layout] || DefaultLayout
})
</script>
