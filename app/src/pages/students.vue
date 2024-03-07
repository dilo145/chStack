<script setup lang="ts">
import { useStudentStore } from "@/store/useStudentStore";
import { computed, ref } from "vue";
import { useRouter } from "vue-router";

const studentStore = useStudentStore();
const router = useRouter();
const isDeleteModalOpen = ref(false);

const id = computed(() => router.currentRoute.value.params.id);

function onDeleteValidate() {
  console.log("delete student validate clicked");
}
</script>

<template>
  <h1>Students page</h1>

  <v-data-table
    :items="studentStore.students"
    :headers="studentStore.headers"
    class="elevation-1 mt-6"
  >
    <template v-slot:item.actions="{ item }">
      <v-icon
        class="me-2"
        size="small"
        @click="
          router.push(`/students/${item.id}`);
          studentStore.isEditing = false;
        "
      >
        mdi-eye
      </v-icon>
      <v-icon
        class="me-2"
        size="small"
        color="secondary"
        @click="
          router.push(`/students/${item.id}`);
          studentStore.isEditing = true;
        "
      >
        mdi-pencil
      </v-icon>
      <v-icon
        size="small"
        color="red"
        @click="
          isDeleteModalOpen = true;
          id = item.id;
        "
      >
        mdi-delete
      </v-icon>
    </template>

    <template v-slot:no-data>
      <v-alert color="error" icon="mdi-alert">
        No students found. Please add a new student.
      </v-alert>
    </template>
  </v-data-table>

  <v-dialog v-model="isDeleteModalOpen" width="500">
    <v-card>
      <v-card-title class="text-center"
        >Are you sure you want to delete this student?</v-card-title
      >
      <v-card-actions class="justify-end">
        <v-btn @click="isDeleteModalOpen = false">Cancel</v-btn>
        <v-btn color="red" @click="onDeleteValidate()">Delete</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
