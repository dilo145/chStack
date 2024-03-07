<script setup lang="ts">
import { useStudentStore } from "@/store/useStudentStore";
import { computed, onMounted, toRefs } from "vue";
import { useRouter } from "vue-router";

const studentStore = useStudentStore();

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();

function onEditLesson() {
  studentStore.updateStudent(id.value.toString());
  isEditing.value = false;
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  studentStore.getStudent(id.toString());
});

const { editStudent, isEditing } = toRefs(studentStore);
</script>

<template>
  <v-col cols="12">
    <h1>Student detail page</h1>

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
      <v-col cols="12">
        <v-checkbox
          v-model="editStudent.invidual"
          :disabled="!isEditing"
          label="invidual"
        >
        </v-checkbox>
      </v-col>

      <v-row>
        <v-col cols="6">
          <v-text-field
            v-model="editStudent.firstName"
            :disabled="!isEditing"
            label="Firstname"
            outlined
            required
          ></v-text-field>
        </v-col>

        <v-col cols="6" md="6">
          <v-text-field
            v-model="editStudent.lastName"
            :disabled="!isEditing"
            label="Lastname"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-text-field
        v-model="editStudent.email"
        :disabled="!isEditing"
        label="Email"
        outlined
        required
      ></v-text-field>

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
          @click="onEditLesson"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
