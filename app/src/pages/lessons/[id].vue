<script setup lang="ts">
import { useLessonStore } from "@/store/useLessonStore";
import { useRessourceStore } from "@/store/useRessourceStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";

const lessonStore = useLessonStore();
const ressourceStore = useRessourceStore();
const isDeleteModalOpen = ref(false);

const id = ref("");
const router = useRouter();

function onEditLesson() {
  lessonStore.updateLesson(id.value.toString());
  isEditing.value = false;
}

function onDeleteValidate() {
  ressourceStore.deleteRessource(parseInt(id.value));
  isDeleteModalOpen.value = false;
}

onMounted(() => {
  id.value = router.currentRoute.value.params.id.toString();

  lessonStore.getLesson(id.value);
  ressourceStore.getRessourcesForLesson(id.value);
});

const { editLesson, isEditing } = toRefs(lessonStore);
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

      <v-row>
        <v-col cols="12" md="6">
          <v-select
            v-model="editLesson.level"
            :items="lessonStore.levels"
            item-title="name"
            label="Level"
            :disabled="!isEditing"
            outlined
            required
            return-object
          >
          </v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            v-model="editLesson.category"
            multiple
            :items="lessonStore.categories"
            item-title="name"
            label="Category"
            :disabled="!isEditing"
            outlined
            required
            return-object
          >
          </v-select>
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
          @click="onEditLesson"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>

    <!-- RESSOURCES -->
    <v-row>
      <v-col cols="12">
        <v-row>
          <v-col cols="6">
            <h2 class="mt-5">External Ressources Link</h2>
          </v-col>

          <v-col cols="6" align-self="end" class="text-end">
            <v-btn
              color="primary"
              variant="outlined"
              @click="
                router.push('/ressources/create');
                lessonStore.isEditing = false;
              "
            >
              <v-icon icon="mdi-plus"></v-icon>
              Add Ressources
            </v-btn>
          </v-col>
        </v-row>

        <v-data-table
          :items="ressourceStore.ressources"
          :headers="ressourceStore.headers"
          class="elevation-1 mt-6"
        >
          <template v-slot:item.actions="{ item }">
            <v-icon
              class="me-2"
              size="small"
              @click="
                router.push(`/ressources/${item.id}`);
                lessonStore.isEditing = false;
              "
            >
              mdi-eye
            </v-icon>
            <v-icon
              size="small"
              color="red"
              @click="
                isDeleteModalOpen = true;
                id = item.id.toString();
              "
            >
              mdi-delete
            </v-icon>
          </template>

          <template v-slot:no-data>
            <div class="text-subtitle">
              No ressource found. Please add a new one.
            </div>
          </template>
        </v-data-table>
      </v-col>
    </v-row>

    <v-dialog v-model="isDeleteModalOpen" width="500">
      <v-card>
        <v-card-title class="text-center"
          >Are you sure you want to delete this item?</v-card-title
        >
        <v-card-actions class="justify-end">
          <v-btn @click="isDeleteModalOpen = false">Cancel</v-btn>
          <v-btn color="red" @click="onDeleteValidate()">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-col>
</template>
