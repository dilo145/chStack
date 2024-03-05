<script setup lang="ts">
import { ref } from "vue";

const drawer = ref(true);
const rail = ref(true);
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

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item
            link
            to="/"
            prepend-icon="mdi-home"
            title="Organisms"
            value="organisms"
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
            title="Grades"
            value="grades"
          ></v-list-item>
          <v-list-item
            link
            to="/students"
            prepend-icon="mdi-account-group-outline"
            title="Students"
            value="students"
          ></v-list-item>
          <v-list-item
            link
            to="/profile"
            prepend-icon="mdi-account"
            title="My Account"
            value="account"
          ></v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-main style="height: 100vh"></v-main>
    </v-layout>
  </v-card>
</template>
