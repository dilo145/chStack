<script setup lang="ts">
import {toRefs} from "vue";
import {useUserStore} from "@/store/useUserStore";
import router from "@/router";

const { user } = toRefs(useUserStore());
const userUserStore = useUserStore();
const role = userUserStore.getRole();

</script>

<template>
  <h1>Messagerie</h1>


</template>


