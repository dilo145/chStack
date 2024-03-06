import api from "@/services/WebService";
import { Training } from "@/types/Training";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";

export const useLessonStore = defineStore("lesson", () => {
  const trainings = ref<Training[]>();
  const isEditing = ref(false);
  const headers = ref<any[]>([
    {
      title: "Title",
      align: "start",
      sortable: false,
      value: "title",
    },
    { title: "Organisme ID", value: "organism_id" },
    { title: "Nom", value: "name" },
    { title: "Goal", value: "goal_training" }
  ]);

  const newTraining = reactive<Training>({
    id: 0,
    organism_id: 0,
    name: "",
    goal_training: "",
  });

  const editTraining = reactive<Training>({
    id: 0,
    organism_id: 0,
    name: "",
    goal_training: "",
  });

  function getTraining() {
    api
      .get<Training[]>("get-training")
      .then((data) => {
        trainings.value = data;
      })
      .catch((err) => {
        console.error("Error fetching training:", err);
      });
  }

  onMounted(() => {
    getTraining();
  });

  return {
    trainings,
    headers,
    newTraining,
    editTraining,
    isEditing,
  };
});
