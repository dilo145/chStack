<script setup lang="ts">
import {toRefs} from "vue";
import {useUserStore} from "@/store/useUserStore";
import router from "@/router";

const { user } = toRefs(useUserStore());
const userUserStore = useUserStore();
const role = userUserStore.getRole();

function onAddExamen() {
  router.push('/examen/create');
}

</script>

<template>
  <h1>Liste des Examens</h1>

  <v-col cols="12" class="d-flex justify-end ga-2">
  <v-btn v-if="role && role === 'ROLE_FORMER'" color="secondary" variant="outlined" @click="onAddExamen">
    <v-icon icon="mdi-import"></v-icon>
    Ajouter un Examen
  </v-btn>

  </v-col>


</template>


