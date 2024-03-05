<script setup lang="ts">
import DataTableActions from "@/components/lessons/DataTableActions.vue";
import { useLessonStore } from "@/store/useLessonStore";

const lessonStore = useLessonStore();
</script>

<template>
  <DataTableActions />

  <v-data-table :items="lessonStore.lessons" class="elevation-1 mt-6">
  </v-data-table>
</template>
