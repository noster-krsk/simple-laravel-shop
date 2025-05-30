<template>
    <v-app>
        <v-main>
            <TheMenu />
            <router-view />
        </v-main>
    </v-app>
</template>

<script setup>
import TheMenu from './components/TheMenu.vue'
</script>
