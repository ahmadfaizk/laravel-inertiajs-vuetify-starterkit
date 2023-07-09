<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <v-app class="bg-grey-lighten-4">
    <v-navigation-drawer v-model="drawer" :rail="rail" permanent expand-on-hover>
      <v-list>
        <v-list-item
          :prepend-avatar="gravatarUrl"
          :title="$page.props.auth.user.name"
          :subtitle="$page.props.auth.user.email"
        />
      </v-list>
      <v-divider />
      <v-list nav>
        <Link v-for="(item, key) in items" :key="key" :href="item.to" class="text-decoration-none text-black">
          <v-list-item
            :prepend-icon="item.icon"
            :title="item.title"
            link
            :exact="item.exact"
            :class="{ 'v-list-item--active': $page.url.startsWith(item.to) }"
          />
        </Link>
        <v-list-item prepend-icon="mdi-exit-to-app">
          <v-list-item-title>
            <Link href="/logout" method="post" as="button" :preserve-scroll="true"> Logout </Link>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar color="primary">
      <v-app-bar-nav-icon @click.stop="rail = !rail" />
      <v-toolbar-title text="Laravel" />
    </v-app-bar>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import md5 from 'crypto-js/md5'

export default {
  data() {
    return {
      drawer: true,
      rail: false,
      items: [
        {
          title: 'Dashboard',
          icon: 'mdi-view-dashboard',
          to: '/dashboard',
        },
        {
          title: 'Persons',
          icon: 'mdi-account-group',
          to: '/persons',
        },
      ],
    }
  },
  computed: {
    gravatarUrl() {
      return `https://www.gravatar.com/avatar/${md5(this.$page.props.auth.user.email)}?s=200`
    },
  },
}
</script>
