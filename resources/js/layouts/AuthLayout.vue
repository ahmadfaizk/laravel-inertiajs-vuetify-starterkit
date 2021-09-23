<template>
  <v-app>
    <v-navigation-drawer
      :mini-variant.sync="miniVariant"
      :clipped="clipped"
      v-model="drawer"
      fixed
      app
    >
      <v-list nav>
        <v-list-item-group :value="indexMenu">
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
            @click="goToPage(item.to)"
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title v-text="item.title" />
            </v-list-item-content>
          </v-list-item>
          <v-list-item @click="logout">
            <v-list-item-action>
              <v-icon>mdi-exit-to-app</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar color="primary" :clipped-left="clipped" fixed dark app>
      <v-app-bar-nav-icon
        v-if="$vuetify.breakpoint.smAndDown"
        @click.stop="drawer = !drawer"
      />
      <v-app-bar-nav-icon v-else @click.stop="miniVariant = !miniVariant" />
      <!-- <v-btn
        icon
        v-if="$vuetify.breakpoint.mdAndUp"
        @click.stop="miniVariant = !miniVariant"
      >
        <v-icon>mdi-menu</v-icon>
      </v-btn> -->
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
export default {
  components: { ApplicationLogo },
  data() {
    return {
      clipped: true,
      drawer: true,
      fixed: false,
      items: [
        { icon: "mdi-apps", title: "Home", to: "home" },
        { icon: "mdi-account", title: "Employee", to: "employee.index" },
      ],
      miniVariant: false,
      indexMenu: null,
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
  mounted() {
    const inertiaUrl = this.$inertia.page.url.split("?")[0];
    const index = this.items.findIndex((item) => {
      const windowUrl = this.route(item.to);
      return windowUrl.includes(inertiaUrl);
    });
    this.indexMenu = index;
  },
  methods: {
    logout() {
      this.$inertia.post("/logout");
    },
    goToPage(page) {
      this.$inertia.visit(this.route(page));
    },
  },
};
</script>
