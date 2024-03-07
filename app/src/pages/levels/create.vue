<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const router = useRouter();

const { newLevel } = toRefs(lessonStore);

function onLevelSubmit() {
  lessonStore.createLevel();
  router.go(-1);
}
</script>

<template>
  <v-col cols="12">
    <h1>New Levels</h1>

    <v-card class="pa-6">
      <v-text-field
        v-model="newLevel.name"
        label="Name"
        outlined
        required
      ></v-text-field>

      <v-text-field
        v-model="newLevel.description"
        label="Description"
        outlined
        required
      ></v-text-field>

      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onLevelSubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
