import api from '@/services/WebService';
import { Category } from '@/types/Category';
import { Lesson } from '@/types/Lesson';
import { Level } from '@/types/Level';
import { defineStore } from 'pinia';
import { onMounted, reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

export const useLessonStore = defineStore('lesson', () => {
  const lessons = ref<Lesson[]>([]);
  const categories = ref<Category[]>([]);
  const levels = ref<Level[]>([]);
  const router = useRouter();
  const isEditing = ref(false);
  const headers = ref<any[]>([
    {
      title: 'Title',
      align: 'start',
      sortable: false,
      value: 'title',
    },
    { title: 'Description', value: 'description' },
    { title: 'Goal', value: 'goal' },
    { title: 'Place', value: 'place' },
    { title: 'Actions', key: 'actions', sortable: false },
  ]);

  const newLesson = reactive<Lesson>({
    id: 0,
    title: '',
    description: '',
    place: '',
    goal: '',
    level: {
      id: 0,
      name: '',
      description: '',
    },
    category: [],
  });

  const editLesson = ref<Lesson>({
    id: 0,
    title: '',
    description: '',
    place: '',
    goal: '',
    level: {
      id: 0,
      name: '',
      description: '',
    },
    category: [],
  });

  function getLesson(id: string) {
    api
      .get<Lesson>(`lessons/${id}`)
      .then((data) => {
        editLesson.value = data;
        console.log(editLesson.value);
      })
      .catch((err) => {
        console.error('Error fetching lesson:', err);
      });
  }

  function getLessons() {
    api
      .get<Lesson[]>('lessons')
      .then((data) => {
        lessons.value = data;
      })
      .catch((err) => {
        console.error('Error fetching lessons:', err);
      });
  }

  function getCategories() {
    api
      .get<Category[]>('categories')
      .then((data) => {
        console.log(data);

        categories.value = data;
      })
      .catch((err) => {
        console.error('Error fetching categories:', err);
      });
  }

  function getLevels() {
    api
      .get<Level[]>('levels')
      .then((data) => {
        levels.value = data;
      })
      .catch((err) => {
        console.error('Error fetching levels:', err);
      });
  }

  function createLesson() {
    api
      .post<Lesson>('lessons/new', newLesson)
      .then((response) => {
        console.log(response);
        router.push(`lessons/${response.id}`);
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function createCategory(category: Category) {
    console.log('createCategory');
  }

  function createLevel(level: Level) {
    console.log('createLevel');
  }

  function updateLesson(id: string) {
    api
      .put<Lesson>('lessons/edit', parseInt(id), editLesson.value)
      .then((response) => {
        getLesson(id);
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function deleteLesson(id: number) {
    api
      .delete<Lesson>('lessons/delete', id)
      .then(() => {
        getLessons();
      })
      .catch((err) => {
        console.error('Error deleting lesson:', err);
      });
  }

  function exportLessonsCSV() {
    const headers = Object.keys(lessons.value[0]);
    let csvContent = headers.join(',') + '\n';

    lessons.value.forEach((lesson: Lesson) => {
      const categories = lesson.category.map((category) => category.name).join('#');

      const level = lesson.level.name;

      const values = [lesson.id, lesson.title, lesson.description, lesson.place, lesson.goal, categories, level];

      csvContent += values.join(',') + '\n';
    });

    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');

    link.href = url;
    link.download = 'lessons.csv';
    link.click();

    URL.revokeObjectURL(url);
  }

  onMounted(() => {
    getLessons();
    getLevels();
    getCategories();
  });

  return {
    lessons,
    headers,
    newLesson,
    editLesson,
    isEditing,
    categories,
    levels,
    getLessons,
    getLevels,
    getCategories,
    createLesson,
    createCategory,
    createLevel,
    deleteLesson,
    getLesson,
    updateLesson,
    exportLessonsCSV,
  };
});
