<script setup lang="ts">
import {onMounted, toRefs} from "vue";
import {useUserStore} from "@/store/useUserStore";
import router from "@/router";
import {useExamenStore} from "@/store/useExamenStore";
import {Exam} from "@/types/Exam";

const { user } = toRefs(useUserStore());
const userUserStore = useUserStore();
const role = userUserStore.getRole();
const examenStore = useExamenStore();
function onAddExamen() {
  router.push('/examen/create');
}
onMounted(() => {
  examenStore.getExam();
})

const { examens } = toRefs(examenStore);
</script>

<template>
  <h1>Liste des Examens</h1>

  <v-col cols="12" class="d-flex justify-end ga-2">
    <v-btn v-if="role && role === 'ROLE_FORMER'" color="primary" variant="outlined" @click="onAddExamen">
      <v-icon icon="mdi-plus"></v-icon>
      Ajouter un Examen
    </v-btn>
  </v-col>

  <v-data-table
    :items="examenStore.examens"
    class="elevation-1 mt-6"
  >
    <template v-slot:item.actions="{ item }">
      <v-icon
        class="me-2"
        size="small"
        @click="
          router.push(`/exams/${item.id}`);
          console.log('detail')
        "
        v-if="role && role === 'ROLE_FORMER'"
      >
        mdi-eye
      </v-icon>
      <v-icon
        size="small"
        color="red"
        @click="
        console.log('delete')
        "
        v-if="role && role === 'ROLE_FORMER'"
      >
        mdi-delete
      </v-icon>
    </template>

    <template v-slot:no-data>
      <div class="text-subtitle">No levels found. Please add a new item.</div>
    </template>
  </v-data-table>


</template>


