<script setup lang="ts">
import { useLessonStore } from '@/store/useLessonStore';
import { useRouter } from 'vue-router';

const router = useRouter();
const lessonStore = useLessonStore();

function onAddLesson() {
  router.push('/lessons/create');
}

function onExportCSV() {
  lessonStore.exportLessonsCSV();
}

function onImportCSV() {
  console.log('import csv click');
}
</script>

<template>
  <v-col cols="12" class="d-flex justify-end ga-2">
    <v-btn color="secondary" variant="outlined" @click="onImportCSV">
      <v-icon icon="mdi-import"></v-icon>
      Import Lessons
    </v-btn>

    <v-btn color="secondary" variant="outlined" @click="onExportCSV">
      <v-icon icon="mdi-export"></v-icon>
      Export Lessons
    </v-btn>

    <v-btn color="primary" variant="outlined" @click="onAddLesson">
      <v-icon icon="mdi-plus"></v-icon>
      Add Lesson
    </v-btn>
  </v-col>
</template>
