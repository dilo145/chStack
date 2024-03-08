<script setup lang="ts">
import { useRessourceStore } from "@/store/useRessourceStore";
import { toRefs } from "vue";
import { useRouter } from "vue-router";

const ressourceStore = useRessourceStore();
const router = useRouter();

const { newRessource } = toRefs(ressourceStore);

function onRessourceSubmit() {
  ressourceStore.createRessource();
}
</script>

<template>
  <v-col cols="12">
    <h1>New Student</h1>

    <v-card class="pa-6">
      <v-col cols="12">
        <v-text-field
          v-model="newRessource.name"
          label="URL"
          outlined
          required
        ></v-text-field>
      </v-col>

      <v-col cols="12">
        <v-text-field
          v-model="newRessource.description"
          label="Description"
          outlined
          required
        ></v-text-field>
      </v-col>

      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onRessourceSubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
