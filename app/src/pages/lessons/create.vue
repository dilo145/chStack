<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const isSnackbarOpen = ref(true);
const router = useRouter();

onMounted(() => {
  lessonStore.getCategories();
  lessonStore.getLevels();
});

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

      <v-text-field
        v-model="newLesson.place"
        label="Place"
        outlined
        required
      ></v-text-field>

      <v-textarea
        v-model="newLesson.description"
        label="Description"
        outlined
        required
      ></v-textarea>

      <v-text-field
        v-model="newLesson.goal"
        label="Goal"
        outlined
        required
      ></v-text-field>

      <v-row>
        <v-col cols="12" md="6">
          <v-select
            v-model="newLesson.level"
            :items="lessonStore.levels"
            item-title="name"
            label="Level"
            outlined
            required
          >
          </v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            v-model="newLesson.category"
            :items="lessonStore.categories"
            item-title="name"
            label="Category"
            outlined
            required
          >
          </v-select>
        </v-col>
      </v-row>

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
