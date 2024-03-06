<script setup lang="ts">
import DataTableActions from "@/components/lessons/DataTableActions.vue";
import { useLessonStore } from "@/store/useLessonStore";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const router = useRouter();
const isDeleteModalOpen = ref(false);
const id = ref(0);

function onDeleteValidate(id: number) {
  lessonStore.deleteLesson(id);
  isDeleteModalOpen.value = false;
}

onMounted(() => {
  lessonStore.getLessons();
});
</script>

<template>
  <h1>Lessons</h1>

  <DataTableActions />

  <v-data-table
    :items="lessonStore.lessons"
    :headers="lessonStore.headers"
    class="elevation-1 mt-6"
  >
    <template v-slot:item.actions="{ item }">
      <v-icon
        class="me-2"
        size="small"
        @click="
          router.push(`/lessons/${item.id}`);
          lessonStore.isEditing = false;
        "
      >
        mdi-eye
      </v-icon>
      <v-icon
        class="me-2"
        size="small"
        color="secondary"
        @click="
          router.push(`/lessons/${item.id}`);
          lessonStore.isEditing = true;
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
        No lessons found. Please add a new lesson.
      </v-alert>
    </template>
  </v-data-table>

  <v-dialog v-model="isDeleteModalOpen" width="500">
    <v-card>
      <v-card-title class="text-center"
        >Are you sure you want to delete this lesson?</v-card-title
      >
      <v-card-actions class="justify-end">
        <v-btn @click="isDeleteModalOpen = false">Cancel</v-btn>
        <v-btn color="red" @click="onDeleteValidate(id)">Delete</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
