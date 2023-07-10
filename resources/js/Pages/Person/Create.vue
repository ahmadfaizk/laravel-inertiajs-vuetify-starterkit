<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  phone: null,
  gender: null,
  address: null,
})

const submit = () => {
  form.post('/persons', {
    onSuccess: () => {
      router.visit('/persons')
    },
  })
}
</script>

<template>
  <Head title="Create Person" />
  <AuthenticatedLayout>
    <div class="mb-5">
      <h5 class="text-h5 font-weight-bold">Create Person</h5>
      <v-breadcrumbs :items="breadcrumbs" class="pa-0 mt-1" />
    </div>
    <v-card>
      <v-form @submit.prevent="submit">
        <v-card-text>
          <v-row>
            <v-col cols="12" sm="12" md="6">
              <v-text-field v-model="form.name" label="Name" variant="underlined" :error-messages="form.errors.name" />
            </v-col>
            <v-col cols="12" sm="12" md="6">
              <v-select
                v-model="form.gender"
                :items="genders"
                item-title="text"
                item-value="value"
                label="Gender"
                variant="underlined"
                :error-messages="form.errors.gender"
              />
            </v-col>
            <v-col cols="12" sm="12" md="6">
              <v-text-field
                v-model="form.email"
                label="Email"
                variant="underlined"
                type="email"
                :error-messages="form.errors.email"
              />
            </v-col>
            <v-col cols="12" sm="12" md="6">
              <v-text-field
                v-model="form.phone"
                label="Phone"
                variant="underlined"
                type="tel"
                :error-messages="form.errors.phone"
              />
            </v-col>
            <v-col cols="12" sm="12">
              <v-textarea
                v-model="form.address"
                label="Address"
                variant="underlined"
                :error-messages="form.errors.address"
              />
            </v-col>
          </v-row>
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
      breadcrumbs: [
        {
          title: 'Dashboard',
          disabled: false,
          href: '/dashboard',
        },
        {
          title: 'Person',
          disabled: false,
          href: '/persons',
        },
        {
          title: 'Create',
          disabled: true,
        },
      ],
    }
  },
}
</script>
