<script setup lang="ts">
import { useTrainingStore } from "@/store/useTrainingStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const trainingStore = useTrainingStore();
const isSnackbarOpen = ref(true);
const router = useRouter();

onMounted(() => {
  trainingStore.getOrganisms();
});

const { newTraining } = toRefs(trainingStore);

function onTrainingSubmit() {
  trainingStore.createTraining();
  router.go(-1);
}
</script>

<template>
  <v-col cols="12">
    <h1>New Classes</h1>

    <v-card class="pa-6">
      <v-text-field
        v-model="newTraining.name"
        label="Nom"
        outlined
        required
      ></v-text-field>

      <v-row>
        <v-col cols="12" md="6">
          <v-select
            v-model="newTraining.organism"
            :items="trainingStore.organisms"
            item-title="name"
            label="Organism"
            outlined
            required
            return-object
          >
          </v-select>
        </v-col>
      </v-row>

      <v-text-field
        v-model="newTraining.goal_training"
        label="Goal"
        outlined
        required
      ></v-text-field>

      

      <!-- buttons at the end  -->
      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onTrainingSubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
