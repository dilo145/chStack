<script setup lang="ts">
import DetailTableActions from "@/components/classes/DetailTableActions.vue";
import { useStudentStore } from "@/store/useStudentStore";
import { useTrainingStore } from "@/store/useTrainingStore";
import { computed, onMounted, toRefs } from "vue";
import { useRouter } from "vue-router";

const trainingStore = useTrainingStore();
const studentStore = useStudentStore();
const addRemStudent = false;

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();
function onEditTraining() {
  trainingStore.updateTraining(id.value.toString());
  isEditing.value = false;
}

function onImportCSV() {
  console.log("import csv click");
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  trainingStore.getTraining(id.toString());
  studentStore.getTrainingStudent(id.toString());
  trainingStore.getOrganisms();
  trainingStore.getStudents();
});

const { editTraining, isEditing } = toRefs(trainingStore);
</script>

<template>
  <v-col cols="12">
    <h1>Classe</h1>
    <v-row>
      <v-btn
        prepend-icon="mdi-pencil"
        v-if="!isEditing"
        @click="isEditing = true"
        color="primary"
        class="ma-3 mb-6"
      >
        Edit</v-btn
      >

      <DetailTableActions />
    </v-row>

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
            :disabled="!isEditing"
            item-title="name"
            :item-value="id"
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
    <v-data-table
      :items="studentStore.students"
      :headers="studentStore.headers"
      class="elevation-1 mt-6"
    >
      <!-- no DATA -->
      <template v-slot:no-data>
        <div class="text-subtitle">
          No students found. Please add a new students.
        </div>
      </template>
    </v-data-table>
  </v-col>
</template>
