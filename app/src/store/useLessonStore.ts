import api from "@/services/WebService";
import { Category } from "@/types/Category";
import { Lesson } from "@/types/Lesson";
import { Level } from "@/types/Level";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

export const useLessonStore = defineStore("lesson", () => {
  const lessons = ref<Lesson[]>();
  const categories = ref<Category[]>([]);
  const levels = ref<Level[]>([]);
  const router = useRouter();
  const isEditing = ref(false);
  const headers = ref<any[]>([
    {
      title: "Title",
      align: "start",
      sortable: false,
      value: "title",
    },
    { title: "Description", value: "description" },
    { title: "Goal", value: "goal" },
    { title: "Place", value: "place" },
    { title: "Actions", key: "actions", sortable: false },
  ]);

  const newLesson = reactive<Lesson>({
    id: 0,
    title: "",
    description: "",
    place: "",
    goal: "",
    level: {
      id: 0,
      name: "",
      description: "",
    },
    category: {
      id: 0,
      name: "",
      description: "",
    },
  });

  const editLesson = ref<Lesson>({
    id: 0,
    title: "",
    description: "",
    place: "",
    goal: "",
    level: {
      id: 0,
      name: "",
      description: "",
    },
    category: {
      id: 0,
      name: "",
      description: "",
    },
  });

  function getLesson(id: string) {
    api
      .get<Lesson>(`get-lesson/${id}`)
      .then((data) => {
        editLesson.value = data;
        console.log(editLesson.value);
      })
      .catch((err) => {
        console.error("Error fetching lesson:", err);
      });
  }

  function getLessons() {
    api
      .get<Lesson[]>("get-lessons")
      .then((data) => {
        lessons.value = data;
      })
      .catch((err) => {
        console.error("Error fetching lessons:", err);
      });
  }

  function getCategories() {
    api
      .get<Category[]>("get-categories")
      .then((data) => {
        categories.value = data;
      })
      .catch((err) => {
        console.error("Error fetching categories:", err);
      });
  }

  function getLevels() {
    api
      .get<Level[]>("get-levels")
      .then((data) => {
        levels.value = data;
      })
      .catch((err) => {
        console.error("Error fetching levels:", err);
      });
  }

  function createLesson() {
    api
      .create<Lesson>("create-lesson", newLesson)
      .then((response) => {
        console.log(response);
        router.push(`lessons/${response.id}`);
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function updateLesson(id: string) {
    api
      .put<Lesson>("update-lesson", parseInt(id), editLesson.value)
      .then((response) => {
        console.log(response);
        editLesson.value = response;
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function deleteLesson(id: number) {
    api
      .delete<Lesson>("delete-lesson", id)
      .then(() => {
        getLessons();
      })
      .catch((err) => {
        console.error("Error deleting lesson:", err);
      });
  }

  onMounted(() => {
    getLessons();
  });

  return {
    lessons,
    headers,
    newLesson,
    editLesson,
    isEditing,
    categories,
    levels,
    getLessons,
    getCategories,
    createLesson,
    deleteLesson,
    getLesson,
    updateLesson,
  };
});
