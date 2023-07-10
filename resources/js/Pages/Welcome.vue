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
        <v-row align="center" justify="center" style="height: 100vh">
          <v-col cols="12" sm="12" md="10" lg="4">
            <v-card class="pa-3 rounded-lg elevation-8">
              <v-card-title>
                <div class="d-flex justify-center mb-4">
                  <ApplicationLogo class="mr-1" style="height: 75" />
                  <VuetifyLogo class="ml-1" style="height: 75" />
                </div>
                <span class="text-h5">Welcome to Laravel + Vuetify</span>
              </v-card-title>
              <v-card-text>
                <p class="text-body-2">
                  Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer
                  or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                </p>
              </v-card-text>
              <v-card-actions>
                <div v-if="props.auth.user != null">
                  <Link href="/dashboard" as="div">
                    <v-btn color="primary">Dashboard</v-btn>
                  </Link>
                </div>
                <div v-else>
                  <div class="d-flex">
                    <Link v-if="props.canLogin" href="/login" class="mr-2" as="div">
                      <v-btn color="primary">Login</v-btn>
                    </Link>
                    <Link v-if="props.canRegister" href="/register" as="div">
                      <v-btn color="secondary">Sign Up</v-btn>
                    </Link>
                  </div>
                </div>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'WelcomePage',
}
</script>
