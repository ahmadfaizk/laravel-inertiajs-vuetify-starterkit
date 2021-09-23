<template>
  <v-app>
    <v-app-bar color="primary" :clipped-left="false" fixed dark app>
      <application-logo class="mr-3" style="max-height: 50" />
      <h2>Laravel App</h2>
      <v-spacer />
    </v-app-bar>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import ApplicationLogo from '../components/ApplicationLogo.vue'
export default {
  components: { ApplicationLogo },
}
</script>
