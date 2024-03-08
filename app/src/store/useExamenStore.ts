import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import {Former} from "@/types/Former";
import {Exam} from "@/types/Exam";
import api from "@/services/WebService";
import {Lesson} from "@/types/Lesson";

export const useExamenStore = defineStore("examen", () => {
  const examens = ref<Exam[]>([]);
  const router = useRouter();
  const isEditing = ref(false);

  const newExamen = reactive<Exam>({
    id :0,
    lesson_id: 0,
    grade : 0,
  });

  const editExamen = ref<Exam>({
    id :0,
    lesson_id: 0,
    grade : 0,
  });

  function getExam() {
    api
        .get<Exam[]>('exams')
        .then((data) => {
          examens.value = data
        })
        .catch((err) => {
          console.error('Error fetching lessons:', err);
        });
  }

  function createExam() {
    api
        .post<Exam>('exams/new', newExamen)
        .then((response) => {
          console.log(response);
          router.push('/exams');
        })
        .catch((err) => {
          console.log(err);
        });
  }

    function updateExam(id: string) {
        api
            .put<Exam>('exams/edit', parseInt(id), editExamen.value)
            .then((response) => {
            getExam();
            isEditing.value = false;
            })
            .catch((err) => {
            console.log(err);
            });
    }

  onMounted(() => {
  });

  return {
      examens,
      newExamen,
      editExamen,
      updateExam,
      getExam,
      createExam
  };
});
