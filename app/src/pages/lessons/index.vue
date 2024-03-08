<script setup lang="ts">
import DataTableActions from "@/components/lessons/DataTableActions.vue";
import { useLessonStore } from "@/store/useLessonStore";
import { useUserStore } from "@/store/useUserStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";
const { user } = toRefs(useUserStore());
const userUserStore = useUserStore();
const role = userUserStore.getRole();

const lessonStore = useLessonStore();
const router = useRouter();
const isDeleteModalOpen = ref(false);
const id = ref(0);
const type = ref<"lesson" | "category" | "level">("lesson");

function onDeleteValidate(id: number) {
  if (type.value === "lesson") lessonStore.deleteLesson(id);
  if (type.value === "category") lessonStore.deleteCategory(id);
  if (type.value === "level") lessonStore.deleteLevel(id);
  isDeleteModalOpen.value = false;
}

onMounted(() => {
  lessonStore.getLessons();
  lessonStore.getCategories();
  lessonStore.getLevels();
});
</script>

<template>
  <h1>Lessons</h1>

  <DataTableActions />

  <!-- LESSONS -->
  <v-data-table
    :items="lessonStore.lessons"
    :headers="lessonStore.headers"
    :loading="lessonStore.loading"
    class="elevation-1 mt-6"
  >
    <template v-slot:item.actions="{ item }">
      <v-icon
        class="me-2"
        size="small"
        @click="
          router.push(`/lessons/${item.id}`);
          lessonStore.isEditing = false;
        "
        v-if="role && role === 'ROLE_FORMER'"
      >
        mdi-eye
      </v-icon>
      <v-icon
        class="me-2"
        size="small"
        color="secondary"
        @click="
          router.push(`/lessons/${item.id}`);
          lessonStore.isEditing = true;
        "
        v-if="role && role === 'ROLE_FORMER'"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        size="small"
        color="red"
        @click="
          type = 'lesson';
          isDeleteModalOpen = true;
          id = item.id;
        "
        v-if="role && role === 'ROLE_FORMER'"
      >
        mdi-delete
      </v-icon>
    </template>

    <template v-slot:no-data>
      <div class="text-subtitle">No levels found. Please add a new item.</div>
    </template>
  </v-data-table>

  <!-- CATEGORIES and LEVELS -->
  <v-row>
    <!-- CATEGORIES -->
    <v-col cols="6">
      <v-row>
        <v-col cols="6">
          <h2 class="mt-5">Categories</h2>
        </v-col>

        <v-col cols="6" align-self="end" class="text-end">
          <v-btn
            color="primary"
            variant="outlined"
            @click="
              router.push('/categories/create');
              lessonStore.isEditing = false;
            "
          >
            <v-icon icon="mdi-plus"></v-icon>
            Add Category
          </v-btn>
        </v-col>
      </v-row>

      <v-data-table
        :items="lessonStore.categories"
        :headers="lessonStore.categoryHeaders"
        class="elevation-1 mt-6"
      >
        <template v-slot:item.actions="{ item }">
          <v-icon
            class="me-2"
            size="small"
            @click="
              router.push(`/categories/${item.id}`);
              lessonStore.isEditing = false;
            "
          >
            mdi-eye
          </v-icon>
          <v-icon
            class="me-2"
            size="small"
            color="secondary"
            @click="
              router.push(`/categories/${item.id}`);
              lessonStore.isEditing = true;
            "
          >
            mdi-pencil
          </v-icon>
          <v-icon
            size="small"
            color="red"
            @click="
              type = 'category';
              isDeleteModalOpen = true;
              id = item.id;
            "
          >
            mdi-delete
          </v-icon>
        </template>

        <template v-slot:no-data>
          <div class="text-subtitle">
            No levels found. Please add a new item.
          </div>
        </template>
      </v-data-table>
    </v-col>

    <!-- LEVELS -->
    <v-col cols="6">
      <v-row>
        <v-col cols="6">
          <h2 class="mt-5">Levels</h2>
        </v-col>

        <v-col cols="6" align-self="end" class="text-end">
          <v-btn
            color="primary"
            variant="outlined"
            @click="
              router.push('/levels/create');
              lessonStore.isEditing = false;
            "
          >
            <v-icon icon="mdi-plus"></v-icon>
            Add Level
          </v-btn>
        </v-col>
      </v-row>

      <v-data-table
        :items="lessonStore.levels"
        :headers="lessonStore.levelHeaders"
        class="elevation-1 mt-6"
      >
        <template v-slot:item.actions="{ item }">
          <v-icon
            class="me-2"
            size="small"
            @click="
              router.push(`/levels/${item.id}`);
              lessonStore.isEditing = false;
            "
          >
            mdi-eye
          </v-icon>
          <v-icon
            class="me-2"
            size="small"
            color="secondary"
            @click="
              router.push(`/levels/${item.id}`);
              lessonStore.isEditing = true;
            "
          >
            mdi-pencil
          </v-icon>
          <v-icon
            size="small"
            color="red"
            @click="
              type = 'level';
              isDeleteModalOpen = true;
              id = item.id;
            "
          >
            mdi-delete
          </v-icon>
        </template>

        <template v-slot:no-data>
          <div class="text-subtitle">
            No levels found. Please add a new item.
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
        <v-btn color="red" @click="onDeleteValidate(id)">Delete</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
