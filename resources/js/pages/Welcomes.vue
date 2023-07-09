<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import VuetifyLogo from '@/Components/VuetifyLogo.vue'
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  auth: Object,
})
</script>

<template>
  <Head title="Welcome" />
  <v-app class="bg-grey-lighten-4">
    <v-main>
      <v-container>
        <v-layout class="d-flex flex-column align-center justify-center" style="height: 100vh">
          <v-card class="pa-8 rounded-lg elevation-8" max-width="600">
            <v-card-title>
              <div class="d-flex justify-center">
                <ApplicationLogo class="mr-1" style="height: 75" />
                <VuetifyLogo class="ml-1" style="height: 75" />
              </div>
              <h2 class="text-h4 mt-8">Welcome to Laravel + Vuetify</h2>
            </v-card-title>
            <v-card-text>
              <p class="text-body-2">
                Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer
                or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
              </p>
            </v-card-text>
            <v-card-actions>
              <div v-if="props.auth.user != null">
                <Link href="/dashboard">
                  <v-btn color="primary">Dashboard</v-btn>
                </Link>
              </div>
              <div v-else>
                <Link v-if="props.canLogin" href="/login" class="mr-2">
                  <v-btn color="primary">Login</v-btn>
                </Link>
                <Link v-if="props.canRegister" href="/register">
                  <v-btn color="secondary">Sign Up</v-btn>
                </Link>
              </div>
            </v-card-actions>
          </v-card>
        </v-layout>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'WelcomePage',
}
</script>
