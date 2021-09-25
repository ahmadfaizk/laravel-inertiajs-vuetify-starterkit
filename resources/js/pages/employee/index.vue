<template>
  <admin-layout>
    <v-banner class="mb-4">
      <div class="d-flex flex-wrap justify-space-between">
        <h5 class="text-h5 font-weight-bold">Employee</h5>
        <v-breadcrumbs :items="breadcrumbs" class="pa-0"></v-breadcrumbs>
      </div>
    </v-banner>
    <div class="d-flex flex-wrap align-center">
      <v-text-field
        v-model="search"
        prepend-inner-icon="mdi-magnify"
        label="Search"
        single-line
        dense
        clearable
        hide-details
        class="py-4"
        solo
        style="max-width: 300px"
      />
      <v-spacer />
      <v-btn color="primary" @click="create">
        <v-icon dark left> mdi-plus </v-icon> New
      </v-btn>
    </div>
    <v-data-table
      :items="items.data"
      :headers="headers"
      :options.sync="options"
      :server-items-length="items.total"
      :loading="isLoadingTable"
      class="elevation-1"
    >
      <template #[`item.index`]="{ index }">
        {{ (options.page - 1) * options.itemsPerPage + index + 1 }}
      </template>
      <template #[`item.action`]="{ item }">
        <v-btn x-small color="yellow" @click="editItem(item)">
          <v-icon small> mdi-pencil </v-icon>
        </v-btn>
        <v-btn x-small color="red" dark @click="deleteItem(item)">
          <v-icon small> mdi-delete </v-icon>
        </v-btn>
      </template>
    </v-data-table>
    <v-dialog v-model="dialog" max-width="500px" scrollable>
      <v-card>
        <v-toolbar dense dark color="primary" class="text-h6">{{
          formTitle
        }}</v-toolbar>
        <v-card-text class="pt-4">
          <v-text-field
            v-model="form.name"
            label="Name"
            :error-messages="form.errors.name"
            type="text"
            outlined
            dense
          />
          <v-text-field
            v-model="form.email"
            label="Email"
            :error-messages="form.errors.email"
            outlined
            dense
          />
          <v-text-field
            v-model="form.job_title"
            label="Job Title"
            :error-messages="form.errors.job_title"
            outlined
            dense
          />
          <v-textarea
            v-model="form.address"
            label="Address"
            :error-messages="form.errors.address"
            outlined
            dense
          />
          <div class="d-flex"></div>
        </v-card-text>
        <v-card-actions>
          <v-btn :disabled="form.processing" text color="error" @click="dialog = false">Cancel</v-btn>
          <v-spacer />
          <v-btn :loading="form.processing" color="primary" @click="submit"
            >Save</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogDelete" max-width="500">
      <v-card>
        <v-toolbar dense dark color="primary" class="text-h6"
          >Delete Employee</v-toolbar
        >
        <v-card-text class="text-h6"
          >Are you sure delete this item ?</v-card-text
        >
        <v-card-actions>
          <v-spacer />
          <v-btn :disabled="form.processing" text color="error" @click="dialogDelete = false">Cancel</v-btn>
          <v-btn :loading="form.processing" text color="primary" @click="destroy">Yes</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </admin-layout>
</template>

<script>
import AdminLayout from "../../layouts/AdminLayout.vue";
export default {
  props: ["items"],
  components: { AdminLayout },
  data() {
    return {
      headers: [
        { text: "No", value: "index", sortable: false },
        { text: "Name", value: "name" },
        { text: "Email", value: "email" },
        { text: "Job Title", value: "job_title" },
        { text: "Created At", value: "created_at" },
        { text: "Actions", value: "action", sortable: false },
      ],
      breadcrumbs: [
        {
          text: "App",
          disabled: false,
          href: "/home",
        },
        {
          text: "Employee",
          disabled: true,
          href: "/employee",
        },
      ],
      dialog: false,
      dialogDelete: false,
      isUpdate: false,
      isLoading: false,
      isLoadingTable: false,
      itemId: null,
      options: {},
      search: null,
      params: {},
      form: this.$inertia.form({
        name: null,
        job_title: null,
        email: null,
        address: null,
      }),
    };
  },
  computed: {
    formTitle() {
      return this.isUpdate ? "Edit Employee" : "Create Employee";
    },
  },
  watch: {
    options: function (val) {
      this.params.page = val.page;
      this.params.page_size = val.itemsPerPage;
      if (val.sortBy.length != 0) {
        this.params.sort_by = val.sortBy[0];
        this.params.order_by = val.sortDesc[0] ? "desc" : "asc";
      } else {
        this.params.sort_by = null;
        this.params.order_by = null;
      }
      this.updateData();
    },
    search: function (val) {
      this.params.search = val;
      this.updateData();
    },
  },
  methods: {
    updateData() {
      this.isLoadingTable = true
      this.$inertia.get("/employee", this.params, {
        preserveState: true,
        preverseScroll: true,
        onSuccess: () => {
          this.isLoadingTable = false
        },
      });
    },
    create() {
      this.dialog = true;
      this.form.reset();
      this.form.clearErrors();
    },
    editItem(item) {
      this.form.clearErrors();
      this.form.name = item.name;
      this.form.email = item.email;
      this.form.job_title = item.job_title;
      this.form.address = item.address;
      this.isUpdate = true;
      this.itemId = item.id;
      this.dialog = true;
    },
    deleteItem(item) {
      this.itemId = item.id;
      this.dialogDelete = true;
    },
    destroy() {
      this.form.delete(route("employee.destroy", this.itemId), {
        preverseScroll: true,
        onSuccess: () => {
          this.dialogDelete = false;
          this.itemId = null;
        },
      });
    },
    submit() {
      if (this.isUpdate) {
        this.form.put(route("employee.update", this.itemId), {
          preverseScroll: true,
          onSuccess: () => {
            this.isLoading = false;
            this.dialog = false;
            this.isUpdate = false;
            this.itemId = null;
            this.form.reset();
          },
        });
      } else {
        this.form.post(route("employee.store"), {
          preverseScroll: true,
          onSuccess: () => {
            this.isLoading = false;
            this.dialog = false;
            this.form.reset();
          },
        });
      }
    },
  },
};
</script>
