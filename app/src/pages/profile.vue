<script setup lang="ts">
import { ref } from 'vue'
const color = ref('white')
import WebService from "@/services/WebService";

const jsonData = ref(null); // Declare jsonData as a reactive variable

// Function to fetch JSON data from the API
async function fetchData() {
  try {
    const response = await WebService.get<any>("users"); // Await the response directly
    jsonData.value = response; // Update jsonData with the response
  } catch (error) {
    console.error("Error fetching data:", error);
    // Handle errors here
  }
}

fetchData();

</script>

<template>
  <div class="mt-4">
    <h1>Mon Profil</h1>

    <v-card
      :color="color"
      class="bg-white mt-10"
    >
      <v-card-item>
        <div>
          <div class="text-h6 mb-1">
            <v-img
              class="mx-auto rounded-circle "
              style="width: 90px; border-radius: 9px;"
              alt="Avatar"
              src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
            ></v-img>
          </div>
       </div>
      </v-card-item>
      <v-form v-if="jsonData">
        <v-container>
          <v-row>
            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
                label="Nom"
                :model-value="jsonData.lastName"
                variant="solo"
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
                label="Prénom"
                :model-value="jsonData.firstName"
                variant="outlined"
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
                label="Email"
                :model-value="jsonData.email"
                variant="outlined"
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              sm="6">
              <v-file-input
                accept="image/png, image/jpeg, image/bmp"
                label="Photo Profil"
                placeholder="Pick an avatar"
                prepend-icon="mdi-camera"
              >
              </v-file-input>
            </v-col>

          </v-row>
        </v-container>
        <div class="d-flex justify-center ga-6 mb-8">
          <v-btn
            class="mt-4"
            color="#7649FF"
            @click="validate"
          >
            Enregistrer
          </v-btn>

          <v-btn
            class="mt-4"
            color="error"
            @click="reset"
          >
            Annuler
          </v-btn>
        </div>
      </v-form>
    </v-card>

  </div>

</template>
<style>
.input_file{
  width: 50px !important;
}
</style>
