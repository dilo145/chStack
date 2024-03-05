<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const isSnackbarOpen = ref(true);
const router = useRouter();

const { newLesson } = toRefs(lessonStore);

function onLessonSubmit() {
  lessonStore.createLesson();
  router.go(-1);
}
</script>

<template>
  <v-col cols="12">
    <h1>New Lessons</h1>

    <v-card class="pa-6">
      <v-text-field
        v-model="newLesson.title"
        label="Name"
        outlined
        required
      ></v-text-field>

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="newLesson.time"
            label="Duration"
            outlined
            required
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="newLesson.place"
            label="Place"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-textarea
        v-model="newLesson.description"
        label="Description"
        outlined
        required
      ></v-textarea>

      <v-col cols="12">
        <h2>Goal</h2>
      </v-col>

      <v-col cols="6">
        <v-text-field
          v-model="newLesson.goal.name"
          label="Name"
          outlined
          required
        ></v-text-field>
      </v-col>

      <v-col cols="12">
        <v-textarea
          v-model="newLesson.goal.description"
          label="Goal"
          outlined
          required
        ></v-textarea>
      </v-col>

      <!-- buttons at the end  -->
      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onLessonSubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
