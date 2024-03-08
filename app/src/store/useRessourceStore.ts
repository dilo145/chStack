import api from '@/services/WebService';
import { Ressource } from '@/types/Ressource';
import { defineStore } from 'pinia';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

export const useRessourceStore = defineStore('ressource', () => {
  const ressources = ref<Ressource[]>([]);
  const isEditing = ref(false);
  const router = useRouter();
  const headers = ref<any[]>([
    {
      title: 'Id',
      align: 'start',
      sortable: false,
      value: 'id',
    },
    {
      title: 'URL',
      value: 'name',
    },
    { title: 'Description', value: 'description' },
    { title: 'Actions', key: 'actions', sortable: false },
  ]);

  const newRessource = reactive<Ressource>({
    id: 0,
    name: '',
    description: '',
    createdAt: '',
    updatedAt: '',
    deletedAt: '',
  });

  const editRessource = ref<Ressource>({
    id: 0,
    name: '',
    description: '',
    createdAt: '',
    updatedAt: '',
    deletedAt: '',
  });

  function getRessource(id: string) {
    api
      .get<Ressource>(`ressources/${id}`)
      .then((data) => {
        editRessource.value = data;
        console.log(editRessource.value);
      })
      .catch((err) => {
        console.error('Error fetching lesson:', err);
      });
  }

  function getRessources() {
    api
      .get<Ressource[]>('ressources')
      .then((data) => {
        console.log('ici frero', data);

        ressources.value = data;
      })
      .catch((err) => {
        console.error('Error fetching ressource:', err);
      });
  }

  function getRessourcesForLesson(id: string) {
    api
      .get<Ressource[]>('ressources/lesson/' + id)
      .then((data) => {
        console.log('ici frero', data);

        ressources.value = data;
      })
      .catch((err) => {
        console.error('Error fetching ressource:', err);
      });
  }

  function createRessource() {
    api
      .post<Ressource>('ressources/new', newRessource)
      .then(() => {
        router.push('/lessons');
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function updateRessource(id: string) {
    api
      .put<Ressource>('ressources/edit', parseInt(id), editRessource.value)
      .then(() => {
        getRessource(id);
        isEditing.value = false;
      })
      .catch((err) => {
        console.log(err);
      });
  }

  function deleteRessource(id: number) {
    api
      .delete<Ressource>('ressources/delete', id)
      .then(() => {
        getRessources();
        location.reload();
      })
      .catch((err) => {
        console.error('Error deleting lesson:', err);
      });
  }

  return {
    ressources,
    newRessource,
    editRessource,
    headers,
    isEditing,
    getRessource,
    getRessources,
    getRessourcesForLesson,
    updateRessource,
    createRessource,
    deleteRessource,
  };
});
