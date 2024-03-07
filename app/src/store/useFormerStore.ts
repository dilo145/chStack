import api from "@/services/WebService";
import { Former } from "@/types/Former";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";

export const useFormerStore = defineStore("former", () => {
  const formers = ref<Former[]>();
  const router = useRouter();

  const newFormer = reactive<Former>({
    speciality: "",
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    photo: "",
  });

  function createFormer() {
    api
      .post<Former>("formers/new", newFormer)
      .then((response) => {
        console.log(response);
        location.reload();
      })
      .catch((err) => {
        console.log(err);
      });
  }

  return {
    newFormer,
    createFormer,
  };
})
