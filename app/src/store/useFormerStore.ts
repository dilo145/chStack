import api from '@/services/WebService';
import { Former } from '@/types/Former';
import { defineStore } from 'pinia';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

export const useFormerStore = defineStore('former', () => {
  const formers = ref<Former[]>();
  const router = useRouter();
  const isEditing = ref(false);

  const newFormer = reactive<Former>({
    speciality: '',
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    photo: '',
  });

  const editFormer = ref<Former>({
    speciality: '',
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    photo: '',
  });

  function getFormerById(id: string) {
    api
      .get<Former>(`formers/${id}`)
      .then((data) => {
        editFormer.value = data;
        return data;
      })
      .catch((err) => {
        console.error('Error fetching former:', err);
      });
  }

  function createFormer() {
    api
      .post<Former>('formers/new', newFormer)
      .then((response) => {
        location.reload();
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function updateFormer(id: string) {
    api
      .put<Former>('formers/edit', parseInt(id), editFormer.value)
      .then((response) => {
        let data = getFormerById(id);
        //edit photo in local storage
        if (data.photo !== '') {
          localStorage.setItem('user.photo', data.photo);
        }

        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  return {
    newFormer,
    editFormer,
    createFormer,
    updateFormer,
    getFormerById,
    isEditing,
  };
});
