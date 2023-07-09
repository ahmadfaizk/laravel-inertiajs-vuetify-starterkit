<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="text-h5 text-medium-emphasis">Dashboard</div>
    <div class="text-subtitle-1 text-medium-emphasis">You're logged in! Feel free to explore the rest of the site.</div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  name: 'DashboardPage',
}
</script>
