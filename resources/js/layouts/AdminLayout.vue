<template>
  <v-app style="background-color: #f5f5f5">
    <navigation-drawer :drawer="drawer" :miniVariant="miniVariant" :items="items" />
    <v-app-bar color="primary" clipped-left fixed dark app>
      <v-app-bar-nav-icon
        v-if="$vuetify.breakpoint.smAndDown"
        @click.stop="drawer = !drawer"
      />
      <v-app-bar-nav-icon v-else @click.stop="miniVariant = !miniVariant" />
      <v-toolbar-title v-text="appName" />
      <v-spacer />
      <div class="d-flex align-center">
        <v-icon dark>mdi-account</v-icon>
        <div class="pl-3">
          <span class="body-1 font-weight-medium">{{ user.name }}</span>
        </div>
      </div>
    </v-app-bar>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import ApplicationLogo from "../components/ApplicationLogo.vue";
import NavigationDrawer from '../components/NavigationDrawer.vue';
export default {
  components: { ApplicationLogo, NavigationDrawer },
  data() {
    return {
      drawer: true,
      items: [
        { icon: "mdi-apps", title: "Home", to: "home" },
        { icon: "mdi-account", title: "Employee", to: "employee.index" },
      ],
      miniVariant: false,
    };
  },
  computed: {
    appName() {
      return this.$page.props.appName;
    },
    user() {
      return this.$page.props.auth.user;
    },
  },
  watch: {
    $page: {
      handler() {
        const message = this.$page.props.flash.message;
        if (message != null) {
          switch (message.type) {
            case "success":
              this.$toast.success(message.text);
              break;
            case "error":
              this.$toast.error(message.text);
              break;
          }
        }
      },
    },
  },
};
</script>
