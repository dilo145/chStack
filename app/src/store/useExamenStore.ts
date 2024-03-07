import { defineStore } from "pinia";
import { onMounted, reactive, ref } from "vue";
import { useRouter } from "vue-router";
import {Former} from "@/types/Former";
import {Exam} from "@/types/Exam";
import api from "@/services/WebService";
import {Lesson} from "@/types/Lesson";

export const useExamenStore = defineStore("examen", () => {
  const examen = ref<Former[]>();
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
        .get<Lesson[]>('lessons')
        .then((data) => {
          exam.value = data;
        })
        .catch((err) => {
          console.error('Error fetching lessons:', err);
        });
  }

  onMounted(() => {
    getExamen();
  });

  return {
    lessons,
    getLessons,

  };
});
