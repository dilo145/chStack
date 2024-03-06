<script setup lang="ts">
import { ref } from "vue"
import { useRouter } from "vue-router";

const search = ref("")
const router = useRouter()

function onAddClick(){
  router.push("/classe_show")
}

const variants = ['Classe 1', 'Classe 2', 'Classe 3', 'Classe 4']
</script>

<template>
  <v-container>
    <v-row>
      <h1>Liste des classes</h1>
    </v-row>
    <v-row max-width="800px">
      <v-text-field
      :rules="rules"
      hide-details="auto"
      label="Recherche"
    ></v-text-field>
    </v-row>
    <v-row align-self="center" justify="start" max-width="800px">
      <v-col
        v-for="(variant, i) in variants"
        :key="i"
        cols="auto"
        
        
        >
        <v-card
          class="mx-auto d-flex flex-column justify-center text-center"
          min-width="250"
          min-height="150"
        >
          <v-card-item >
            <div>
              <div class="text-overline mb-1">
                {{ variant }}
              </div>
              <div class="text-h6 mb-1">
                IW M1
              </div>
            </div>
          </v-card-item>

          <v-card-actions class="justify-center">
            <v-btn>
              Modifier
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <!-- la colonne d'ajout -->
      <v-col @click="onAddClick">
        <v-card
          min-width="250"
          max-width="250"
          min-height="150"
          class="d-flex justify-center"

        >
          <v-btn width="100%" height="150px">
            <v-icon icon="mdi-plus" size="x-large"></v-icon>
          </v-btn>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
