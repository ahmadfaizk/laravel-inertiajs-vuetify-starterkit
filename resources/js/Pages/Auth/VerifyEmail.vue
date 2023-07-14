<script setup>
import { computed } from 'vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  status: {
    type: String,
  },
})

const form = useForm({})

const submit = () => {
  form.post('/email/verification-notification')
}
const verificationLinkSent = computed(() => props.status === 'verification-link-sent')
</script>

<template>
  <GuestLayout>
    <Head title="Email Verification" />
    <v-form @submit.prevent="submit">
      <div class="text-subtitle-2 text-medium-emphasis mb-4">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we we
        just emailed to you? If you didn't receive the email, we will gladly send you another.
      </div>
      <div v-if="verificationLinkSent" class="text-subtitle-2 mb-4">
        A new verification link has been sent to the email address you provided during registration.
      </div>
      <div class="d-flex justify-space-between align-center">
        <v-btn :loading="form.processing" type="submit" color="primary"> Resend Verification Email </v-btn>
        <Link href="/logout" method="post" class="text-black">Log Out</Link>
      </div>
    </v-form>
  </GuestLayout>
</template>
