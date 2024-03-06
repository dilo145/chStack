<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { computed, onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const isEditing = ref(false);

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();

function onEditLesson() {
  lessonStore.updateLesson(id.value.toString());
  isEditing.value = false;
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  lessonStore.getLesson(id.toString());
});

const { editLesson } = toRefs(lessonStore);
</script>

<template>
  <v-col cols="12">
    <h1>Lesson detail page</h1>

    <v-btn
      v-if="!isEditing"
      @click="isEditing = true"
      color="primary"
      class="mb-6"
    >
      <v-icon icon="mdi-pencil"> </v-icon>
      Edit</v-btn
    >

    <v-card class="pa-6">
      <v-text-field
        v-model="editLesson.title"
        :disabled="!isEditing"
        label="Name"
        outlined
        required
      ></v-text-field>

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="editLesson.place"
            :disabled="!isEditing"
            label="Place"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-textarea
        v-model="editLesson.description"
        :disabled="!isEditing"
        label="Description"
        outlined
        required
      ></v-textarea>

      <v-text-field
        v-model="editLesson.goal"
        :disabled="!isEditing"
        label="Goal"
        outlined
        required
      ></v-text-field>

      <!-- buttons at the end  -->
      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn
          color="primary"
          variant="outlined"
          @click="onEditLesson"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
