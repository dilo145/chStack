import { Lesson } from "@/types/Lesson";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useLessonStore = defineStore("lesson", () => {
  const lessons = ref<Lesson[]>([
    {
      id: 1,
      title: "Introduction to Vue 3",
      description: "Learn the basics of Vue 3, through pratice and examples",
      goal: "Understand the basics of Vue 3",
      time: "10:00",
      place: "Online",
    },
    {
      id: 2,
      title: "Vue 3 Forms",
      description: "Learn how to create forms in Vue 3",
      goal: "Understand how to create forms in Vue 3",
      time: "14:00",
      place: "Online",
    },
    {
      id: 3,
      title: "Vue 3 Composition API",
      description: "Learn how to use the Composition API in Vue 3",
      goal: "Understand how to use the Composition API in Vue 3",
      time: "16:00",
      place: "Online",
    },
  ]);
  const headers = ref([
    {
      text: "Title",
      align: "start",
      sortable: false,
      value: "title",
    },
    { text: "Description", value: "description" },
    { text: "Goal", value: "goal" },
    { text: "Time", value: "time" },
    { text: "Place", value: "place" },
  ]);

  return {
    lessons,
    headers,
  };
});
