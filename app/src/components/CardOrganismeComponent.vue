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
  <v-col cols="auto">
    <v-list>
      <v-list-item v-for="i in liste" :key="i.id">
        <v-card
          @click="router.push('/organisms/' + i.id)"
          max-width="100%"
          max-height="25%"
          class="d-flex gy-3 border cursor-pointer"
        >
          <img height="200px" :src="i.logo"></img>

          <div class="w-75">
            <v-card-title>{{ i.name }}</v-card-title>

          </div>
        </v-card>
      </v-list-item>
    </v-list>
    <v-btn
      class="w-100"
      color="primary"
      @click="router.push('/organisms/create')"
    >
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </v-col>
</template>
