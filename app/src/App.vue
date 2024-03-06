<script lang="ts" setup>
import SideNavigationComponent from "@/components/SideNavigationComponent.vue";
import {ref} from "vue";
const token = ref(false)
</script>

<template>
  <v-app>
    <div class="d-flex content" v-if="token">
      <SideNavigationComponent />
      <v-container>
        <router-view />
      </v-container>
    </div>
    <div v-if="!token">
      <router-view />
    </div>
  </v-app>
</template>

<style>
.content {
  background-color: #f3efff;
}
</style>
