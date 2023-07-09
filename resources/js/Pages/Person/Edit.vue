<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  person: {
    type: Object,
    required: true,
  },
})

const form = useForm({
  name: props.person.name,
  email: props.person.email,
  phone: props.person.phone,
  gender: props.person.gender,
  address: props.person.address,
})

const submit = () => {
  form.patch('/persons/' + props.person.id)
}
</script>

<template>
  <Head title="Edit Person" />
  <AuthenticatedLayout>
    <v-card>
      <v-form @submit.prevent="submit">
        <v-card-title>
          <span class="text-h5">Edit Person</span>
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
          <v-btn type="submit" color="primary">Save</v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </AuthenticatedLayout>
</template>

<script>
export default {
  name: 'PersonEdit',
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
