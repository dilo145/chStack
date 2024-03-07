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
  <v-list-item v-for="i in liste" :key="i.id">
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
  <v-btn
    class="w-100"
    color="primary"
    @click="router.push('/organisms/create')"
  >
    <v-icon>mdi-plus</v-icon>
  </v-btn>
</template>
