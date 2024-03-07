<script setup lang="ts">
import { useTrainingStore } from "@/store/useTrainingStore";
import { useStudentStore } from "@/store/useStudentStore";
import { computed, onMounted, toRefs } from "vue";
import { useRouter } from "vue-router";

const trainingStore = useTrainingStore();
const studentStore = useStudentStore();

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();

function onEditTraining() {
  trainingStore.updateTraining(id.value.toString());
  isEditing.value = false;
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  trainingStore.getTraining(id.toString());
  studentStore.getTrainingStudent(id.toString());
});

const { editTraining, isEditing } = toRefs(trainingStore);
</script>

<template>
  <v-col cols="12">
    <h1>Class</h1>

    <v-btn
      v-if="!isEditing"
      @click="isEditing = true"
      color="primary"
      class="mb-6"
    >
      <v-icon icon="mdi-pencil"> </v-icon>
      Edit</v-btn
    >

    <v-card class="pa-6">
      <v-text-field
        v-model="editTraining.name"
        :disabled="!isEditing"
        label="Name"
        outlined
        required
      ></v-text-field>
    
      <v-row>
        <v-col cols="12" md="6">
          <v-select
            v-model="editTraining.organism"
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

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="editTraining.goalTraining"
            :disabled="!isEditing"
            label="Goal training"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>


      <!-- buttons at the end  -->
      <v-row class="mt-6 justify-end">
        <v-btn
          variant="text"
          @click="
            router.go(-1);
            isEditing = false;
          "
          >Cancel</v-btn
        >
        <v-btn
          color="primary"
          variant="outlined"
          @click="onEditTraining"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>

  <v-col>
    <h2>Liste des étudiants</h2>
    <v-data-table :items="studentStore.students" :headers="studentStore.headers" class="elevation-1 mt-6">

      <!-- no DATA -->
      <template v-slot:no-data>
      <v-alert color="error" icon="mdi-alert">
        No students found. Please add a new students.
      </v-alert>
    </template>
    </v-data-table>
  </v-col>
</template>
