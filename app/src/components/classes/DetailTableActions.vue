<script setup lang="ts">
import { useRouter } from "vue-router";
import { onMounted } from "vue";
import axios from 'axios';
import api from '@/services/WebService';

const router = useRouter();
const id = router.currentRoute.value.params.id;


// onMounted(() => {
//   onExportCSV(id.toString());
// });

function onExportCSV(id: string) {
  api
    .get(`/students/export/${id}`,{responseType:'blob'})
    .then((response:any) => {
      // Handle the CSV data response
      console.log(response);
      const urlObject = window.URL.createObjectURL(new Blob([response]));
      const a = document.createElement('a');
      a.href = urlObject
      a.setAttribute('download','data.csv');
      a.click()
      return response;
    })
    .catch(err => {
      console.error('Error exporting data:', err);
    });
}

function onImportCSV() {
  console.log("import csv click");
}
</script>

<template>
    <!-- POPUP + bouton Add/Remove etudiant-->
    <v-dialog max-width="1200">
      <!-- Bouton du POPUP-->
  <template v-slot:activator="{ props: activatorProps }">
    <v-btn
      v-bind="activatorProps"
      prepend-icon="mdi-pencil"
      color="secondary"
      class="ma-3 mb-6"
      text="Add/Remove étudiant"
      variant="flat"
    ></v-btn>
  </template>

    <!-- FIN Bouton du POPUP-->

  <template v-slot:default="{ isActive }">
    <v-card title="Tous les étudiants" class="pa-6">
    <v-select
      label="Select les étudiants"
      :items="['test1','test2']"
      variant="outlined"
      return-object
      multiple
      
></v-select>
    <!--FIN TABLE étudiants-->

      <!--popup btns-->
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          text="Cancel"
          @click="isActive.value = false"
        ></v-btn>
        <v-btn
          text="Submit"
          @click="isActive.value = false"
        ></v-btn>
      </v-card-actions>
      <!--FIN popup btns-->

    </v-card>
  </template>
    </v-dialog>
    <!--FIN POPUP-->
    
    
    <v-col class="d-flex justify-end">
      <v-btn  prepend-icon="mdi-export" class="mr-3"  variant="outlined" @click="()=>onExportCSV(id.toString())" color="secondary">
      Export étudiants
    </v-btn>
      <v-btn  prepend-icon="mdi-import" class=""  variant="outlined" @click="onImportCSV" color="primary">
      Import étudiants
    </v-btn>

    
    </v-col>
    
</template>