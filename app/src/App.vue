<script lang="ts" setup>
import SideNavigationComponent from "@/components/SideNavigationComponent.vue";
</script>

<template>
  <v-app>
    <div class="d-flex">
      <SideNavigationComponent />
      <v-container>
        <router-view />
      </v-container>
    </div>
  </v-app>
</template>
