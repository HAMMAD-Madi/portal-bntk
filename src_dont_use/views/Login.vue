<template>


    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body">
                                <v-container class="login">
                                    <!-- <v-card style="width: 350px">
                                        <v-card-text> -->
                                            <form style="width: 100%" @submit.prevent="submit">
                                                <v-text-field outlined v-model="email" type="email" label="E-mail"
                                                    variant="outlined" bg-color="white" name="email">
                                                </v-text-field>
                                                <v-text-field id="user-password" outlined v-model="password"
                                                    type="password" autocomplete="current-password" label="Wachtwoord"
                                                    variant="outlined" bg-color="white" name="password">
                                                </v-text-field>
                                                <button class="btn btn-lg btn-primary w-100 mt-4 mb-0" type="submit">Login</button>

                                                <div class="mt-5 error">{{ errorMessage }}</div>
                                            </form>
                                        <!-- </v-card-text>
                                    </v-card> -->
                                </v-container>
                            </div>
                            <!-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-1 text-sm mx-auto">
                                    Forgot your password? Reset your password
                                    <a href="https://argon-dashboard-laravel.creative-tim.com/reset-password"
                                        class="text-primary text-gradient font-weight-bold">here</a>
                                </p>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="https://argon-dashboard-laravel.creative-tim.com/register"
                                        class="text-primary text-gradient font-weight-bold">Sign up</a>
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                            >
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">"BNTK Dashboard"</h4>
                            <p class="text-white position-relative">
                                Securely log in to access your dashboard, manage your profile, and utilize all features of this Vue-based application.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'

const email = ref()
const password = ref()
const errorMessage = ref()


async function submit() {
    const auth = useAuthStore()

    try {
        await auth.login(email.value, password.value)
    } catch (e) {
        if (e == 'Bad credentials') {
            errorMessage.value = 'E-mail of wachtwoord is incorrect.'
        }
    }
}

</script>

<style>
.login {
    display: flex;
    justify-content: center;
}

.error {
    color: red;
    font-weight: bold;
}
</style>
