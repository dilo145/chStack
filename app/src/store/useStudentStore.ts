import api from "@/services/WebService";
import { Student } from "@/types/Student";
import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";

export const useStudentStore = defineStore("student", () => {
  const students = ref<Student[]>([]);
  const isEditing = ref(false);
  const headers = ref<any[]>([
    {
      title: "Id",
      align: "start",
      sortable: false,
      value: "id",
    },
    {
      title: "Firstname",
      value: "firstName",
    },
    { title: "Lastname", value: "lastName" },
    { title: "email", value: "email" },
    { title: "Actions", key: "actions", sortable: false },
  ]);

  const newStudent = reactive<Student>({
    id: 0,
    invidual: true,
    registrations: [],
    answer: [],
    firstName: "",
    lastName: "",
    email: "",
    photo: "",
    userIdentifier: "",
    roles: [],
    password: "",
    createdAt: "",
    updatedAt: "",
    deletedAt: "",
    messagesSended: [],
    messagesRecived: [],
  });

  const editStudent = ref<Student>({
    id: 0,
    invidual: true,
    registrations: [],
    answer: [],
    firstName: "",
    lastName: "",
    email: "",
    photo: "",
    userIdentifier: "",
    roles: [],
    password: "",
    createdAt: "",
    updatedAt: "",
    deletedAt: "",
    messagesSended: [],
    messagesRecived: [],
  });

  function getLesson(id: string) {
    api
      .get<Student>(`students/${id}`)
      .then((data) => {
        editStudent.value = data;
        console.log(editStudent.value);
      })
      .catch((err) => {
        console.error("Error fetching lesson:", err);
      });
  }

  function getStudents() {
    api
      .get<Student[]>("students")
      .then((data) => {
        students.value = data;
      })
      .catch((err) => {
        console.error("Error fetching students:", err);
      });
  }

  function updateStudent(id: string) {
    api
      .put<Student>("students/edit", parseInt(id), editStudent.value)
      .then(() => {
        getLesson(id);
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function deleteStudent(id: number) {
    api
      .delete<Student>("students/delete", id)
      .then(() => {
        getStudents();
      })
      .catch((err) => {
        console.error("Error deleting lesson:", err);
      });
  }

  onMounted(() => {
    getStudents();
  });

  return {
    students,
    headers,
    isEditing,
    getStudents,
    updateStudent,
    deleteStudent,
  };
});
