<script>
import {Link, router} from "@inertiajs/vue3";

export default {
  components: {
    Link
  },
  props: {
    menus: {
      type: Array,
      required: true
    },
    subMenus: {
      type: Array,
      required: true
    }
  },
  methods: {
    logout() {
      router.post('/logout')
    }
  },
  data() {
    return {
      drawer: true
    }
  }
}
</script>

<template>
  <v-navigation-drawer expand-on-hover rail v-model="drawer" class="bg-blue-darken-2 nav">
    <v-list>
      <v-list-item
          v-for="(menu, index) in menus"
          :key="index"
          :prepend-icon="menu.icon"
          class="nav-link"
      >
        <Link :href="menu.url">{{ menu.label }}</Link>
      </v-list-item>
      <v-list-group
          v-for="(grupo, subMenuIndex) in subMenus"
          :key="subMenuIndex"
          :value="grupo.label"
      >
        <template v-slot:activator="{ props }">
          <v-list-item :prepend-icon="grupo.icon" v-bind="props" :title="grupo.label"></v-list-item>
        </template>
        <v-list-item
            v-for="(subitem, i) in grupo.subitens"
            :key="i"
            :value="subitem.label"
            class="nav-link"
        >
          <Link :href="subitem.url">{{ subitem.label }}</Link>
        </v-list-item>
      </v-list-group>
      <v-list-item prepend-icon="fas fa-sign-out-alt" class="bg-red" @click="logout">
        Sair
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
  <v-app-bar>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    <v-app-bar-title>O Chefia</v-app-bar-title>
  </v-app-bar>
</template>

<style scoped>
.nav {
  height: 100vh;
}

.nav-link {
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.nav-link:hover {
  background-color: rgba(187, 222, 251, 0.04);
}

.nav-link a {
  color: white;
  text-decoration: none;
}
</style>
