<template>

    <div class="message-container">
        <div class="row">
            <div class="message">
                <h1>Pagina niet gevonden</h1>
                
                <v-btn class="mt-5" @click="router.go(-2)">Ga terug naar de vorige pagina</v-btn>
            </div>
        </div>
    </div>

</template>

<script setup>
    import { useRouter } from 'vue-router'
    const router = useRouter()
</script>

<style>

.message-container {
    height: calc(100vh - 48px);
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.row {
    width: auto;
}
.message {
    padding: 5px;
    width: 500px;
    height: 500px;
    margin: 10px;
    font-weight: bold;
    font-size: 1em;
    text-align: center;
}

</style>