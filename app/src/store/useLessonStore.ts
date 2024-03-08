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
  const loading = ref(true);
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
  const categoryHeaders = ref<any[]>([
    {
      title: 'Id',
      align: 'start',
      sortable: false,
      value: 'id',
    },
    { title: 'Name', value: 'name' },
    { title: 'Description', value: 'description' },
    { title: 'Actions', key: 'actions', sortable: false },
  ]);
  const levelHeaders = ref<any[]>([
    {
      title: 'Id',
      align: 'start',
      sortable: false,
      value: 'id',
    },
    { title: 'Name', value: 'name' },
    { title: 'Description', value: 'description' },
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

  const newCategory = reactive<Category>({
    id: 0,
    name: '',
    description: '',
  });

  const editCategory = ref<Category>({
    id: 0,
    name: '',
    description: '',
  });

  const newLevel = reactive<Level>({
    id: 0,
    name: '',
    description: '',
  });

  const editLevel = ref<Level>({
    id: 0,
    name: '',
    description: '',
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

  function getCategory(id: string) {
    api
      .get<Category>(`categories/${id}`)
      .then((data) => {
        editCategory.value = data;
        console.log(editCategory.value);
      })
      .catch((err) => {
        console.error('Error fetching category:', err);
      });
  }

  function getLevels() {
    api
      .get<Level[]>('levels')
      .then((data) => {
        console.log(data);

        levels.value = data;
      })
      .catch((err) => {
        console.error('Error fetching levels:', err);
      });
  }

  function getLevel(id: string) {
    api
      .get<Level>(`levels/${id}`)
      .then((data) => {
        editLevel.value = data;
        console.log(editLevel.value);
      })
      .catch((err) => {
        console.error('Error fetching level:', err);
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

  function createCategory() {
    api
      .post<any>('categories/new', newCategory)
      .then(() => {
        router.push('lessons');
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function createLevel() {
    api
      .post<any>('levels/new', newLevel)
      .then(() => {
        router.push('lessons');
      })
      .catch((err) => {
        console.log(err);
      });
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

  function updateCategory(id: string) {
    api
      .put<Category>('categories/edit', parseInt(id), editCategory.value)
      .then(() => {
        getCategory(id);
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function updateLevel(id: string) {
    api
      .put<Level>('levels/edit', parseInt(id), editLevel.value)
      .then(() => {
        getLevel(id);
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

  function deleteCategory(id: number) {
    api
      .delete<any>('categories/delete', id)
      .then(() => {
        getCategories();
      })
      .catch((err) => {
        console.error('Error deleting category:', err);
      });
  }

  function deleteLevel(id: number) {
    api
      .delete<any>('levels/delete', id)
      .then(() => {
        getLevels();
      })
      .catch((err) => {
        console.error('Error deleting level:', err);
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
    loading.value = false;
  });

  return {
    loading,
    lessons,
    headers,
    newLesson,
    editLesson,
    newCategory,
    editCategory,
    newLevel,
    editLevel,
    isEditing,
    categories,
    levels,
    categoryHeaders,
    levelHeaders,
    getLessons,
    getCategories,
    getCategory,
    getLevels,
    getLevel,
    createLesson,
    createCategory,
    createLevel,
    deleteLesson,
    deleteCategory,
    deleteLevel,
    getLesson,
    updateLesson,
    updateCategory,
    updateLevel,
    exportLessonsCSV,
  };
});
