<script setup lang="ts">
import { ref } from "vue";
import DataTableActions from "@/components/classes/DataTableActions.vue";
import { useRouter } from "vue-router";
import { useTrainingStore } from "@/store/useTrainingStore";

const search = ref()
const router = useRouter()
const trainingStore = useTrainingStore();

const isDeleteModalOpen = ref(false);
const id = ref(0);

function onDeleteValidate(id: number) {
  trainingStore.deleteTraining(id);
  isDeleteModalOpen.value = false;
}

</script>

<template>
  <h1>Liste des classes</h1>
  <DataTableActions />
  
  <v-data-table :items="trainingStore.trainings" :headers="trainingStore.headers" class="elevation-1 mt-6">
    <template v-slot:item.actions="{ item }">
      <v-icon class="me-2" size="small" @click="
        router.push(`/classes/${item.id}`);
        trainingStore.isEditing = false;
      ">
        mdi-eye
      </v-icon>
      <v-icon class="me-2" size="small" color="secondary" @click="
        router.push(`/classes/${item.id}`);
        trainingStore.isEditing = true;
      ">
        mdi-pencil
      </v-icon>
      <v-icon size="small" color="red" @click="
        isDeleteModalOpen = true;
        id = item.id;
      ">
        mdi-delete
      </v-icon>
    </template>

    <!-- No data message -->

    <template v-slot:no-data>
      <v-alert color="error" icon="mdi-alert">
        No training found. Please add a new training.
      </v-alert>
    </template>
  </v-data-table>

  <!-- Delete confirmation dialog -->
  <v-dialog v-model="isDeleteModalOpen" width="500">
    <v-card>
      <v-card-title class="text-center">Are you sure you want to delete this training?</v-card-title>
      <v-card-actions class="justify-end">
        <v-btn @click="isDeleteModalOpen = false">Cancel</v-btn>
        <v-btn color="red" @click="onDeleteValidate(id)">Delete</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
