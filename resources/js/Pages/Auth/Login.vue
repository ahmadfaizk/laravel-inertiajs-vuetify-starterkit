<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
})

const form = useForm({
  email: 'johndoe@mail.com',
  password: 'password',
  remember: false,
})
const showPassword = ref(false)

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}
</script>
<script>
export default {
  name: 'LoginPage',
}
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />
    <v-form @submit.prevent="submit">
      <div class="text-subtitle-1 text-medium-emphasis">Email</div>
      <v-text-field
        v-model="form.email"
        type="email"
        variant="outlined"
        density="compact"
        placeholder="Email address"
        prepend-inner-icon="mdi-email-outline"
        :error-messages="form.errors.email"
      />
      <div class="d-flex align-center justify-space-between">
        <div class="text-subtitle-1 text-medium-emphasis">Password</div>
        <Link
          class="text-caption text-decoration-none text-blue"
          href="/forgot-password"
          rel="noopener noreferrer"
          target="_blank"
        >
          Forgot password?</Link
        >
      </div>
      <v-text-field
        v-model="form.password"
        density="compact"
        variant="outlined"
        placeholder="Enter your password"
        prepend-inner-icon="mdi-lock-outline"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        :type="showPassword ? 'text' : 'password'"
        :error-messages="form.errors.password"
        @click:append-inner="showPassword = !showPassword"
      />
      <v-checkbox v-model="form.remember" label="Remember me" />

      <v-btn :loading="form.processing" type="submit" block color="primary" class="mb-12">Login</v-btn>
    </v-form>
    <v-card-text class="text-center">
      <Link class="text-blue text-decoration-none" href="/register">
        Sign up now <v-icon icon="mdi-chevron-right" />
      </Link>
    </v-card-text>
  </GuestLayout>
</template>
