import api from "@/services/WebService";
import { Lesson } from "@/types/Lesson";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

export const useLessonStore = defineStore("lesson", () => {
  const lessons = ref<Lesson[]>();
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
    time: "",
    goal: {
      name: "",
      description: "",
    },
  });

  const editLesson = ref<Lesson>({
    id: 0,
    title: "",
    description: "",
    place: "",
    time: "",
    goal: {
      name: "",
      description: "",
    },
  });

  function getLesson(id: string) {
    api
      .get<Lesson>(`get-lesson/${id}`)
      .then((data) => {
        editLesson.value = data;
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
    getLessons,
    createLesson,
    deleteLesson,
    getLesson,
  };
});
