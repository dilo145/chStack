<script setup lang="ts">
import { useStudentStore } from "@/store/useStudentStore";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const studentStore = useStudentStore();
const router = useRouter();
const isDeleteModalOpen = ref(false);

const id = ref(0);

function onDeleteValidate() {
  studentStore.deleteStudent(id.value);
  isDeleteModalOpen.value = false;
}

onMounted(() => {
  studentStore.getStudents();
});
</script>

<template>
  <h1>Students page</h1>

  <v-col cols="12" class="d-flex justify-end ga-2">
    <v-btn
      color="primary"
      variant="outlined"
      @click="router.push('/students/create')"
    >
      <v-icon icon="mdi-plus"></v-icon>
      Add user
    </v-btn>
  </v-col>

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

    <template v-slot:item.firstName="{ item }">
      <v-chip v-if="item.deletedAt !== null" color="red">
        {{ item.firstName }}
      </v-chip>
      <v-chip v-else color="primary">
        {{ item.firstName }}
      </v-chip>
    </template>

    <template v-slot:item.invidual="{ item }">
      <v-chip v-if="item.invidual === true" color="primary"> indiviual </v-chip>
      <v-chip v-else> non-invidual </v-chip>
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
