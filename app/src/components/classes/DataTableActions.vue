<script setup lang="ts">
import { useRouter } from "vue-router";

const router = useRouter();

function onAddLesson() {
  router.push("/classes/create");
}

function onExportCSV() {
  console.log("export csv click");
}

function onImportCSV() {
  console.log("import csv click");
}
</script>

<template>
  <v-col cols="12" class="d-flex justify-end ga-2">
    <v-btn color="secondary" variant="outlined" @click="onExportCSV">
      <v-icon icon="mdi-import"></v-icon>
      Add Training
    </v-btn>

    <v-btn color="secondary" variant="outlined" @click="onImportCSV">
      <v-icon icon="mdi-export"></v-icon>
      Add Training
    </v-btn>

    <v-btn color="primary" variant="outlined" @click="onAddLesson">
      <v-icon icon="mdi-plus"></v-icon>
      Add Training
    </v-btn>
  </v-col>
</template>
