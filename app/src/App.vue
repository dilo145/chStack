<script lang="ts" setup>
import SideNavigationComponent from "@/components/SideNavigationComponent.vue";
import { ref } from "vue";
const token = ref(false);
</script>

<template>
  <v-app>
    <div class="d-flex content">
      <SideNavigationComponent />
      <v-container>
        <router-view />
      </v-container>
    </div>
  </v-app>
</template>

<style>
.content {
  background-color: #f3efff;
}
</style>
