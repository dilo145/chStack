<script setup lang="ts">
import DataTableActions from "@/components/lessons/DataTableActions.vue";
import { useLessonStore } from "@/store/useLessonStore";
import { onMounted } from "vue";

const lessonStore = useLessonStore();

onMounted(() => {
  console.log("ici: ", lessonStore.headers);
});
</script>

<template>
  <DataTableActions />

  <v-data-table
    :items="lessonStore.lessons"
    :headers="lessonStore.headers"
    class="elevation-1 mt-6"
  >
  </v-data-table>
</template>
