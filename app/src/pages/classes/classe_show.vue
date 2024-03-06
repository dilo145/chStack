
<!-- Liste.vue -->

<template>
  <div>
    <h1>Liste des éléments</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="element in lists" :key="element.id">
          <td>{{ element.id }}</td>
          <td>{{ element.name }}</td>
          <!-- Ajoutez d'autres colonnes si nécessaire -->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import api from "@/services/WebService";

const lists = ref<Array<any>>([]);

onMounted(async () => {
  const list = await api.get<Array<any>>("get-training");
  lists.value = list;
  return lists;
})

</script>

<style>
/* Ajoutez du style CSS si nécessaire */
</style>
