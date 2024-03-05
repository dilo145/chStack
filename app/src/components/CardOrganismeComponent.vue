<script setup lang="ts"></script>
<template>
  <v-col cols="auto">
    <v-list>
      <v-list-item v-for="i in 2" :key="i">
        <v-card
          max-width="100%"
          max-height="25%"
          class="d-flex gy-3 border cursor-pointer"
        >
          <v-img height="200px" src="../assets/esgi_logo.png" cover></v-img>

          <div class="w-75">
            <v-card-title>Ecole supérieur de genie informatique</v-card-title>

            <v-card-subtitle> ESGI </v-card-subtitle>

            <v-card-text>
              ESGI, Grande école d'informatique en alternance à Paris propose 9
              filières avec diplômes reconnus par l'État en Cycle Bachelor et en
              Cycle Mastère.
            </v-card-text>
          </div>
        </v-card>
      </v-list-item>
    </v-list>
    <v-btn class="w-100">
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </v-col>
</template>
