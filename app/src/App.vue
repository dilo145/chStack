<script lang="ts" setup>
import SideNavigationComponent from "@/components/SideNavigationComponent.vue";
import { ref } from "vue";
const user = JSON.parse(localStorage.getItem("user") || "{}");
</script>

<template>
  <v-app>
    <div class="d-flex content" v-if="user" >
      <SideNavigationComponent />
      <v-container>
        <router-view />
      </v-container>
    </div>
    <router-view v-else/>
  </v-app>

</template>

<style>
.content {
  background-color: #f3efff;
}
</style>
