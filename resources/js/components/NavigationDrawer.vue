<template>
  <v-navigation-drawer
    :mini-variant.sync="miniVariant"
    clipped
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
</template>

<script>
export default {
  props: {
    drawer: {
      type: Boolean,
      default: true,
    },
    miniVariant: {
      type: Boolean,
      default: false,
    },
    items: {
      type: Array,
      default: [],
    }
  },
  computed: {
    indexMenu() {
      const inertiaUrl = this.$inertia.page.url.split("?")[0];
      const index = this.items.findIndex((item) => {
        const windowUrl = this.route(item.to);
        return windowUrl.includes(inertiaUrl);
      });
      return index;
    },
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
