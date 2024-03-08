<script lang="ts" setup>
import SideNavigationComponent from "@/components/SideNavigationComponent.vue";
import {computed, ref} from "vue";
import {useUserStore} from "@/store/useUserStore";
const userStore = useUserStore();

</script>

<template>
  <v-app>
    <div class="d-flex content" v-if="userStore.isUserSet" >
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
