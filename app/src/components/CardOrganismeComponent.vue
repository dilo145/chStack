<script setup lang="ts">
import router from "@/router";

defineProps({
  liste: {
    type: Object,
    required: true,
  },
});
</script>
<template>
  <v-row class="mb-5 mt-5" align="center" justify="center">
    <v-btn
      class="w-auto"
      center
      color="primary"
      @click="router.push('/organisms/create')"
    >
      Create new organism
    </v-btn>
  </v-row>

  <v-list-item v-for="i in liste" :key="i.id" v-if="liste.length > 0">
    <v-card
      @click="router.push('/organisms/' + i.id)"
      class="d-flex flex-column flex-sm-row gy-3 align-left border cursor-pointer"
    >
      <v-img :src="i.logo"> </v-img>
      <div class="w-75">
        <v-card-title>{{ i.name }}</v-card-title>
      </div>
    </v-card>
  </v-list-item>
  <v-alert v-else>No organism found</v-alert>
</template>
