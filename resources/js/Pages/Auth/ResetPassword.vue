<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post('/reset-password', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}

const showPassword = ref(false)
</script>

<template>
  <GuestLayout>
    <Head title="Reset Password" />
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
      <div class="text-subtitle-1 text-medium-emphasis">Password</div>
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
      <div class="text-subtitle-1 text-medium-emphasis">Password Confirmation</div>
      <v-text-field
        v-model="form.password_confirmation"
        density="compact"
        variant="outlined"
        placeholder="Enter your password"
        prepend-inner-icon="mdi-lock-outline"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        :type="showPassword ? 'text' : 'password'"
        :error-messages="form.errors.password_confirmation"
        @click:append-inner="showPassword = !showPassword"
      />
      <v-btn :loading="form.processing" class="mt-4" type="submit" block color="primary"> Reset Password </v-btn>
    </v-form>
  </GuestLayout>
</template>
