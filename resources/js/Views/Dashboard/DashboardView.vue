<script>
    import { router } from '@inertiajs/vue3'
    import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
    export default {
      mounted() {
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
      components: {
        NavbarSistemaComponent
      }
    }
</script>

<template>
  <v-layout>
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus" />
    <v-main>
      <h1>Dashboard</h1>
    </v-main>
  </v-layout>
</template>

<style scoped>

</style>
