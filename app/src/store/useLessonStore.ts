import api from "@/services/WebService";
import { Lesson } from "@/types/Lesson";
import { defineStore } from "pinia";
import { onMounted, ref } from "vue";

export const useLessonStore = defineStore("lesson", () => {
  const lessons = ref<Lesson[]>();
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
  ]);

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

  onMounted(() => {
    7;
    getLessons();
  });

  return {
    lessons,
    headers,
    getLessons,
  };
});
