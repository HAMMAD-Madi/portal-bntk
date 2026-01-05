<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

// Import your layout components
import Sidebar from './Sidebar.vue'
import Header from './Header.vue'
import Footer from './Footer.vue'

const route = useRoute()

const isAuthPage = computed(() =>
  ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality'].includes(route.name)
)

const isProfilePage = computed(() =>
  ['profile', 'profile-static'].includes(route.name)
)
</script>

<template v-if="!isAuthPage">
  <div v-if="!isProfilePage" class="min-height-300 bg-primary position-absolute w-100"></div>
  <div
    v-else
    class="position-absolute w-100 min-height-300 top-0"
    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;"
  >
    <span class="mask bg-primary opacity-6"></span>
  </div>
  <Sidebar />
  <div class="main-content border-radius-lg">
    <Header />
    <slot />
    <Footer />
  </div>
</template>

