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
  <div class="main-content border-radius-lg">
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
        <div class="col-12">
          <!-- Navbar -->
          <nav
            class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
            <div class="container-fluid">
              <router-link to="/home"  class="navbar-brand font-weight-bolder ms-lg-0 ms-3 ">
                BNTK
              </router-link>
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <router-link to="/home" class="nav-link d-flex align-items-center me-2 active" aria-current="page">
                      <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                      Dashboard
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="#" class="nav-link me-2">
                      <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                      Sign Up
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/login" class="nav-link me-2">
                      <i class="fas fa-key opacity-6 text-dark me-1"></i>
                      Sign In
                    </router-link>
                  </li>
                </ul>
                <!-- <ul class="navbar-nav d-lg-block d-none">
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com/product/argon-dashboard-laravel" target="_blank"
                      class="btn btn-sm mb-0 me-1 btn-primary">Free Download</a>
                  </li>
                </ul> -->
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
      </div>
    </div>
    <slot />
    <Footer />
  </div>
</template>
