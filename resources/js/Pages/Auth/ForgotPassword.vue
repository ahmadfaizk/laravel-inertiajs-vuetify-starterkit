<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post('/forgot-password')
}
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />
    <v-form @submit.prevent="submit">
      <div class="text-subtitle-2 text-medium-emphasis mb-4">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset
        link that will allow you to choose a new one.
      </div>
      <div v-if="status" class="text-subtitle-2 mb-4">
        {{ status }}
      </div>
      <v-text-field
        v-model="form.email"
        type="email"
        variant="outlined"
        density="compact"
        placeholder="Email address"
        prepend-inner-icon="mdi-email-outline"
        :error-messages="form.errors.email"
      />
      <v-btn :loading="form.processing" class="mt-4" type="submit" block color="primary">
        Email Password Reset Link
      </v-btn>
    </v-form>
  </GuestLayout>
</template>
