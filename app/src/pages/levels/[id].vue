<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { computed, onMounted, toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();

function onEditLevel() {
  lessonStore.updateLevel(id.value.toString());
  isEditing.value = false;
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  lessonStore.getLevel(id.toString());
});

const { editLevel, isEditing } = toRefs(lessonStore);
</script>

<template>
  <v-col cols="12">
    <h1>Level detail page</h1>

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
        v-model="editLevel.name"
        :disabled="!isEditing"
        label="Name"
        outlined
        required
      ></v-text-field>

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="editLevel.description"
            :disabled="!isEditing"
            label="Description"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row class="mt-6 justify-end">
        <v-btn
          variant="text"
          @click="
            router.go(-1);
            isEditing = false;
          "
          >Cancel</v-btn
        >
        <v-btn
          color="primary"
          variant="outlined"
          @click="onEditLevel"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
