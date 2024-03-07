import api from "@/services/WebService";
import { Organism } from "@/types/Organism";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

export const useOrganismStore = defineStore("Organism", () => {
  const Organisms = ref<Organism[]>([]);
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

  const newOrganism = reactive<Organism>({
    id: 0,
    name: "",
    logo: "",
    trainings: [],
    created_by: 0,
  });

  const editOrganism = ref<Organism>({
    id: 0,
    name: "",
    logo: "",
    trainings: [],
    created_by: 0,
  });

  function getOrganism(id: string) {
    api
      .get<Organism>(`organisms/${id}`)
      .then((data) => {
        editOrganism.value = data;
        console.log(editOrganism.value);
      })
      .catch((err) => {
        console.error("Error fetching Organism:", err);
      });
  }

  function getOrganisms() {
    api
      .get<Organism[]>("organisms")
      .then((data) => {
        Organisms.value = data;
      })
      .catch((err) => {
        console.error("Error fetching Organisms:", err);
      });
  }

  function createOrganism() {
    api
      .post<Organism>("organisms/new", newOrganism)
      .then((response) => {
        console.log(response);
        router.push(`organisms/${response.id}`);
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function updateOrganism(id: string) {
    api
      .put<Organism>("organisms/edit", parseInt(id), editOrganism.value)
      .then((response) => {
        getOrganism(id);
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function deleteOrganism(id: number) {
    api
      .delete<Organism>("organisms/delete", id)
      .then(() => {
        getOrganisms();
      })
      .catch((err) => {
        console.error("Error deleting Organism:", err);
      });
  }

  onMounted(() => {
    getOrganisms();
  });

  return {
    Organisms,
    headers,
    newOrganism,
    editOrganism,
    isEditing,
    getOrganisms,
    createOrganism,
    deleteOrganism,
    getOrganism,
    updateOrganism,
  };
});
