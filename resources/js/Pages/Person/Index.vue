<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Person" />
  <AuthenticatedLayout>
    <div class="text-h4 text-medium-emphasis mb-5">Person</div>
    <v-card class="pa-4">
      <div class="d-flex">
        <v-text-field v-model="search" label="Search" variant="underlined" prepend-inner-icon="mdi-magnify" />
        <v-spacer />
        <v-spacer />
        <Link href="/persons/create">
          <v-btn color="primary">Create</v-btn>
        </Link>
      </div>
      <v-data-table-server
        :items="data.data"
        :items-length="data.total"
        :headers="headers"
        :search="search"
        class="elevation-0"
        :loading="isLoadingTable"
        @update:options="loadItems"
      >
        <template #[`item.gender`]="{ item }">{{ item.columns.gender == 'male' ? 'Male' : 'Female' }}</template>
        <template #[`item.action`]="{ item }">
          <Link :href="`/persons/${item.value}/edit`">
            <v-icon color="warning" icon="mdi-pencil" size="small" />
          </Link>
          <v-icon class="ml-2" color="error" icon="mdi-delete" size="small" @click="deleteItem(item)" />
        </template>
      </v-data-table-server>
    </v-card>
    <v-row justify="center">
      <v-dialog v-model="deleteDialog" persistent width="auto">
        <v-card>
          <v-card-text>Are you sure you want to delete this item?</v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn color="error" text @click="deleteDialog = false">Cancel</v-btn>
            <v-btn color="primary" :loading="isLoading" text @click="submitDelete">Delete</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </AuthenticatedLayout>
</template>

<script>
export default {
  name: 'PersonIndex',
  props: {
    data: {
      type: Object,
    },
  },
  data() {
    return {
      headers: [
        { title: 'Name', key: 'name' },
        { title: 'Gender', key: 'gender' },
        { title: 'Email', key: 'email' },
        { title: 'Phone Number', key: 'phone' },
        { title: 'Created At', key: 'created_at' },
        { title: 'Action', key: 'action', sortable: false },
      ],
      isLoadingTable: false,
      search: null,
      options: {},
      deleteDialog: false,
      isLoading: false,
      deleteId: null,
    }
  },
  methods: {
    loadItems({ page, itemsPerPage, sortBy, search }) {
      this.isLoadingTable = true
      this.$inertia.get(
        '/persons',
        {
          page: page,
          limit: itemsPerPage,
          sort: sortBy[0],
          search: search,
        },
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.isLoadingTable = false
          },
        },
      )
    },
    deleteItem(item) {
      this.deleteId = item.value
      this.deleteDialog = true
    },
    submitDelete() {
      this.isLoading = true
      this.$inertia.delete(`/persons/${this.deleteId}`, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.isLoading = false
          this.deleteDialog = false
        },
      })
    },
  },
}
</script>
