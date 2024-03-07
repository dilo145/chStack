<script setup lang="ts">
import CardOragnismeComponent from "@/./components/CardOrganismeComponent.vue";
import CheckUser from "@/services/CheckUser";
import api from "@/services/WebService";

console.log(CheckUser.isFormer());
console.log(CheckUser.isStudent());
console.log(CheckUser.getId());

if (CheckUser.isFormer()) {
  api
    .get<any>("/organisms/by-Creator/" + CheckUser.getId())
    .then((response) => {
      console.log(response);
    });
}
</script>
<template>
  <h1>Organisms page</h1>
  <CardOragnismeComponent />
</template>
