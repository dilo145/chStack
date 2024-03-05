<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { ref, toRefs } from "vue";

const lessonStore = useLessonStore();
const isSnackbarOpen = ref(true);

const { newLesson } = toRefs(lessonStore);
</script>

<template>
  <v-col cols="12">
    <h1>Lessons</h1>

    <v-card class="pa-6">
      <v-text-field label="title" v-model="newLesson.title"> </v-text-field>

      <v-text-field label="description" v-model="newLesson.description">
      </v-text-field>

      <v-text-field label="place" v-model="newLesson.place"> </v-text-field>

      <v-date-picker v-model="newLesson.time"> </v-date-picker>

      <!-- TODO: goal -->

      <v-row align="end">
        <v-btn variant="text" @click="">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="">Submit</v-btn>
      </v-row>
    </v-card>
  </v-col>

  <v-snackbar v-model="isSnackbarOpen">
    <div class="text-h1">Value inside the snackbar</div>
    <v-btn @click="isSnackbarOpen = false"></v-btn>
  </v-snackbar>
</template>
