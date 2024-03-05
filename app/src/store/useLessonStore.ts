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
  ]);
});
