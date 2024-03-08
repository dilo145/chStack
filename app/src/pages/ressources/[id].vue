<script setup lang="ts">
import { useRessourceStore } from "@/store/useRessourceStore";
import { computed, onMounted, toRefs } from "vue";
import { useRouter } from "vue-router";

const ressourceStore = useRessourceStore();

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();

function onEditLesson() {
  ressourceStore.updateRessource(id.value.toString());
  isEditing.value = false;
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  ressourceStore.getRessource(id.toString());
});

const { editRessource, isEditing } = toRefs(ressourceStore);
</script>

<template>
  <v-col cols="12">
    <h1>Student detail page</h1>

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
      <v-col cols="12">
        <v-text-field
          v-model="editRessource.name"
          :disabled="!isEditing"
          label="URL"
          outlined
          required
        ></v-text-field>
      </v-col>

      <v-col cols="12">
        <v-text-field
          v-model="editRessource.description"
          :disabled="!isEditing"
          label="Description"
          outlined
          required
        ></v-text-field>
      </v-col>

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
          @click="onEditLesson"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
