<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  phone: null,
  gender: null,
  address: null,
})

const submit = () => {
  form.post('/persons')
}
</script>

<template>
  <Head title="Create Person" />
  <AuthenticatedLayout>
    <v-card>
      <v-form @submit.prevent="submit">
        <v-card-title>
          <span class="text-h5">Create Person</span>
        </v-card-title>
        <v-card-text>
          <v-text-field v-model="form.name" label="Name" variant="outlined" :error-messages="form.errors.name" />
          <v-text-field v-model="form.email" label="Email" variant="outlined" :error-messages="form.errors.email" />
          <v-text-field v-model="form.phone" label="Phone" variant="outlined" :error-messages="form.errors.phone" />
          <v-select
            v-model="form.gender"
            :items="genders"
            item-title="text"
            item-value="value"
            label="Gender"
            variant="outlined"
            :error-messages="form.errors.gender"
          />
          <v-textarea v-model="form.address" label="Address" variant="outlined" :error-messages="form.errors.address" />
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn type="submit" color="primary">Create</v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </AuthenticatedLayout>
</template>

<script>
export default {
  name: 'PersonCreate',
  data() {
    return {
      genders: [
        { text: 'Male', value: 'male' },
        { text: 'Female', value: 'female' },
      ],
    }
  },
}
</script>
