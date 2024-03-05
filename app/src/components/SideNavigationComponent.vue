<script setup lang="ts">
import { ref } from "vue";
import WebService from "@/services/WebService";

const drawer = ref(true);
const rail = ref(false);

// Function to fetch JSON data from the API
const fetchData = async () => {
  try {
    const response = await WebService.get<any>("users"); // Await the response directly
    let jsonData = response; // Extract the JSON data from the response
    console.log(jsonData.firstName);
  } catch (error) {
    console.error("Error fetching data:", error);
    // Handle errors here
  }
};
</script>

<template>
  <v-card>
    <v-layout>
      <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
      >
        <v-divider></v-divider>

        <v-img v-if="!rail" src="../assets/logo.png" class="ma-2 w-50 mb-4"></v-img>
        <v-img v-if="rail" src="../assets/small-logo.png" class="w-50 mx-auto ma-2"></v-img>
        <v-list density="compact" nav>
          <v-list-item
            link
            to="/"
            prepend-icon="mdi-home"
            title="Ecoles"
            value="organisms"
          ></v-list-item>
          <v-list-item
            link
            to="/lessons"
            prepend-icon="mdi-school"
            title="Cours"
            value="lessons"
          ></v-list-item>
          <v-list-item
            link
            to="/classes"
            prepend-icon="mdi-school"
            title="Classes"
            value="classes"
          ></v-list-item>
          <v-list-item
            link
            to="/grades"
            prepend-icon="mdi-book-open-variant"
            title="Notes / Examen"
            value="grades"
          ></v-list-item>
          <v-list-item
            link
            to="/students"
            prepend-icon="mdi-account-group-outline"
            title="Etudiants"
            value="students"
          ></v-list-item>
          <v-list-item
            link
            to="/profile"
            prepend-icon="mdi-account"
            title="Mon Compte"
            value="account"
          ></v-list-item>
        </v-list>

        <template v-slot:append>
          <div class="pa-2">
            <v-list-item
              prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
              title="Lacos TN ou quoi le boss"
              nav
            >
              <template v-slot:append>
                <v-btn
                  icon="mdi-chevron-left"
                  variant="text"
                  @click.stop="rail = !rail"
                ></v-btn>
              </template>
            </v-list-item>
          </div>
        </template>
      </v-navigation-drawer>
      <v-main style="height: 100vh"></v-main>
    </v-layout>
  </v-card>
</template>
