<script setup lang="ts">
import { useOrganismStore } from "@/store/useOrganismStore";
import { ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const OrganismStore = useOrganismStore();
const isSnackbarOpen = ref(true);
const router = useRouter();

const { newOrganism } = toRefs(OrganismStore);

function onOrganismSubmit() {
  OrganismStore.createOrganism();
  router.go(-1);
}
</script>

<template>
  <v-col cols="12">
    <h1>New Organism</h1>

    <v-card class="pa-6">
      <v-text-field
        v-model="newOrganism.name"
        label="Name"
        outlined
        required
      ></v-text-field>

      <v-text-field
        v-model="newOrganism.logo"
        label="Url Logo"
        outlined
        required
      ></v-text-field>
      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onOrganismSubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
