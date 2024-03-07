import api from "@/services/WebService";
import { Organism } from "@/types/Organism";
import { Training } from "@/types/Training";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

export const useTrainingStore = defineStore("training", () => {
  const trainings = ref<Training[]>();
  const organisms = ref<Organism[]>([]);
  const router = useRouter();
  const isEditing = ref(false);
  const headers = ref<any[]>([
    {
      title: "ID",
      align: "start",
      sortable: false,
      value: "id",
    },
    { title: "Organism", value: "organism.name" },
    { title: "Nom", value: "name" },
    { title: "Goal", value: "goalTraining" },
    { title: "Actions", key: "actions", sortable: false },
  ]);

  const newTraining = reactive<Training>({
    id: 0,
    organism: {
      id: 0,
      name: "",
      logo: ""
    },
    name: "",
    goal_training: "",
  });

  const editTraining = ref<Training>({
    id: 0,
    organism: {
      id: 0,
      name: "",
      logo: ""
    },
    name: "",
    goal_training: "",
  });


  function getTrainings() {
    api
      .get<Training[]>("trainings")
      .then((data) => {
        trainings.value = data;
      })
      .catch((err) => {
        console.error("Error fetching training:", err);
      });
  }

  function getTraining(id: string) {
    api
      .get<Training>(`/trainings/getOne/${id}`)
      .then((data) => {
        editTraining.value = data;
        console.log(editTraining.value);
      })
      .catch((err) => {
        console.error("Error fetching training:", err);
      });
  }

  function createTraining() {
    api
      .post<Training>("/trainings/new", newTraining)
      .then((response) => {
        console.log(response);
        router.push(`classes/${response.id}`);
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function updateTraining(id: string) {
    api
      .put<Training>("trainings/update", parseInt(id), editTraining.value)
      .then((response) => {
        console.log(response);
        editTraining.value = response;
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function deleteTraining(id: number) {
    api
      .delete<Training>("trainings/delete", id)
      .then(() => {
        getTrainings();
      })
      .catch((err) => {
        console.error("Error deleting training:", err);
      });
  }

  function getOrganisms() {
    api
      .get<Organism[]>("organisms")
      .then((data) => {
        organisms.value = data;
      })
      .catch((err) => {
        console.error("Error fetching levels:", err);
      });
  }

  onMounted(() => {
    getTrainings();
  });

  return {
    trainings,
    headers,
    newTraining,
    editTraining,
    isEditing,
    organisms,
    getTrainings,
    getOrganisms,
    createTraining,
    deleteTraining,
    getTraining,
    updateTraining,
  };
});
