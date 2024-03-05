<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const isEditing = ref(false);

const router = useRouter();

function onEditLesson() {}

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
      >Edit</v-btn
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
            v-model="editLesson.time"
            :disabled="!isEditing"
            label="Duration"
            outlined
            required
          ></v-text-field>
        </v-col>
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

      <v-col cols="12">
        <h2>Goal</h2>
      </v-col>

      <v-col cols="6">
        <v-text-field
          v-model="editLesson.goal.name"
          :disabled="!isEditing"
          label="Name"
          outlined
          required
        ></v-text-field>
      </v-col>

      <v-col cols="12">
        <v-textarea
          v-model="editLesson.goal.description"
          :disabled="!isEditing"
          label="Goal"
          outlined
          required
        ></v-textarea>
      </v-col>

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
