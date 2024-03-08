<script setup lang="ts">
import { useTrainingStore } from "@/store/useTrainingStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";
import {useLessonStore} from "@/store/useLessonStore";
import router from "@/router";
import {useExamenStore} from "@/store/useExamenStore";

const lessonStore = useLessonStore();
const examenStore = useExamenStore();
const { newLesson } = toRefs(lessonStore);
const { newExamen } = toRefs(examenStore);

function onExamenSubmit(){
  newExamen.value.lesson_id = newLesson.value.id;
  examenStore.createExam();
  router.go(-1);
}

onMounted(() => {
  lessonStore.getLessons();
});


</script>

<template>
  <v-col cols="12">
    <h1 class="mb-10">Nouvel Examen</h1>

    <v-card class="pa-6">

      <v-row>
        <v-col cols="12" md="6">
          <v-select
            v-model="newLesson.id"
            :items="lessonStore.lessons"
            item-title="title"
            item-value="id"
            label="Cours"
            outlined
            required
          >
          </v-select>
        </v-col>
      </v-row>

      <!-- buttons at the end  -->
      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onExamenSubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
