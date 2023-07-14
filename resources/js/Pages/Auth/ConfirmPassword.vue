<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
  status: {
    type: String,
  },
})

const form = useForm({
  password: '',
})
const showPassword = ref(false)

const submit = () => {
  form.post('/confirm-password', {
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Confirm Password" />
    <v-form @submit.prevent="submit">
      <div class="text-subtitle-2 text-medium-emphasis mb-4">
        This is a secure area of the application. Please confirm your password before continuing.
      </div>
      <v-text-field
        v-model="form.password"
        variant="outlined"
        density="compact"
        placeholder="Password"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        :type="showPassword ? 'text' : 'password'"
        :error-messages="form.errors.password"
        @click:append-inner="showPassword = !showPassword"
      />
      <v-btn :loading="form.processing" class="mt-4" type="submit" block color="primary"> Confirm </v-btn>
    </v-form>
  </GuestLayout>
</template>
