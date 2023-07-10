<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <v-app class="bg-grey-lighten-4">
    <v-main>
      <v-container fluid>
        <v-row align="center" justify="center" style="height: 100vh">
          <v-col cols="12" sm="12" md="10" lg="3">
            <div class="d-flex justify-center">
              <Link href="/" as="div">
                <ApplicationLogo style="height: 75" />
              </Link>
            </div>
            <v-card class="px-6 py-4 mt-3 elevation-2 rounded-lg">
              <slot />
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
