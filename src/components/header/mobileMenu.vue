<script setup>
  import {ref, defineProps} from 'vue'

  const props = defineProps(['menuItems'])
  const drawer = ref(false)
</script>

<template>
  <div class="mobile-menu block xl:hidden">
    <v-navigation-drawer
      class="pt-[30px]"
      v-model="drawer"

      temporary
      location="right"
    >
      <v-list density="compact" nav>
        <ul>
          <li v-for="item in props.menuItems" class="mb-2">
            <v-list-item :title="item.title" :to="{path: item.route.path, hash: item.route.hash}" v-if="item.hash == true"></v-list-item>
            <v-list-item :title="item.title" :to="{name: item.route}" v-else></v-list-item>
          </li>
        </ul>
      </v-list>
    </v-navigation-drawer>
    <v-btn
      color="primary"
      icon="mdi mdi-menu"
      flat
      @click.stop="drawer = !drawer"
    >

    </v-btn>
  </div>
</template>

<style lang="scss">
.mobile-menu {
  .v-navigation-drawer__scrim {
    position: fixed!important;
  }
  .v-list-item--active > .v-list-item__overlay {
    opacity: 0!important;
  }
}
</style>
