<template>
  <v-app style="background-color: #f5f5f5">
    <slot />
  </v-app>
</template>

<script>
export default {
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
