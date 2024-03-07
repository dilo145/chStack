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

onMounted(() => {
  lessonStore.getLessons();
});
</script>

<template>
  <h1>Liste des Examens</h1>





</template>


