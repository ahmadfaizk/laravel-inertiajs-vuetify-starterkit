<template>
  <v-app>
    <v-main>
      <v-container fluid>
        <v-row align="center" justify="center" style="height: 100vh">
          <v-col cols="12" sm="12" md="10" lg="4">
            <v-card>
              <v-card-title class="d-flex align-center justify-center">
                <Link :href="route('/')">
                  <application-logo style="height: 75" />
                </Link>
              </v-card-title>
              <v-card-text v-if="status">
                <v-alert type="success">{{ status }}</v-alert>
              </v-card-text>
              <v-card-text>
                <p class="mb-2">You forgot your password? Here you can easily retrieve a new password.</p>
              </v-card-text>
              <v-card-text>
                <v-form @submit.prevent="submit">
                  <v-text-field
                    v-model="form.email"
                    prepend-inner-icon="mdi-email"
                    label="Email"
                    type="email"
                    outlined
                    dense
                    :error-messages="form.errors.email"
                  />
                  <v-btn :loading="form.processing" type="submit" block color="primary" class="mt-3"
                    >Request New Password</v-btn
                  >
                </v-form>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import ApplicationLogo from "../../components/ApplicationLogo.vue";
export default {
  props: {
    status: String,
  },
  components: { ApplicationLogo },
  data() {
    return {
      showPassword: false,
      isLoading: false,
      form: this.$inertia.form({
        email: null,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post("/forgot-password");
    },
  },
};
</script>
