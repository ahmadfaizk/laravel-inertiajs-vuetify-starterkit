<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="text-h5 text-medium-emphasis">Dashboard</div>
    <v-card class="mt-5">
      <v-card-text>
        <div class="text-h6 text-medium-emphasis">Welcome back, {{ $page.props.auth.user.name }}!</div>
      </v-card-text>
    </v-card>
  </AuthenticatedLayout>
</template>

<script>
export default {
  name: 'DashboardPage',
}
</script>
