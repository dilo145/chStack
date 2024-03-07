import api from "@/services/WebService";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { Training } from "@/types/Training";
import { Student } from "@/types/Student";

export const useStudentStore = defineStore("student", () => {

  const students = ref<Student[]>();
  const trainings = ref<Training[]>();
  const router = useRouter();
  const headers = ref<any[]>([
    {
      title: "Nom",
      align: "start",
      sortable: false,
      value: "lastName",
    },
    { title: "Prénom", value: "firstName" },
    { title: "Email", value: "email" },
    { title: "Actions", key: "actions", sortable: false },
  ]);


  function getTrainingStudent(id: string) {
    api
      .get<Student[]>(`users/get_by_training/${id}`)
      .then((data) => {
        students.value = data;
        console.log(students);
      })
      .catch((err) => {
        console.error("Error fetching training:", err);
      });
  }

  return {
    students,
    headers,
    trainings,
    getTrainingStudent,

  };


});