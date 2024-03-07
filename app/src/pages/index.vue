<script setup lang="ts">
import CardOragnismeComponent from "@/./components/CardOrganismeComponent.vue";
import CheckUser from "@/services/CheckUser";
import api from "@/services/WebService";
import { ref } from "vue";

const listeOrganismes = ref([]);
if (CheckUser.isFormer()) {
  api
    .get<any>("/organisms/by-Creator/" + CheckUser.getId())
    .then((response) => {
      listeOrganismes.value = response;
    });
}
</script>
<template>
  <h1>Organisms page</h1>
  <CardOragnismeComponent :liste="listeOrganismes" />
</template>
