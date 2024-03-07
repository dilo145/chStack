<script setup lang="ts">
import { useStudentStore } from "@/store/useStudentStore";
import { toRefs } from "vue";
import { useRouter } from "vue-router";

const studentStore = useStudentStore();
const router = useRouter();

const { newStudent } = toRefs(studentStore);

function onStudentubmit() {
  studentStore.createStudent();
}
</script>

<template>
  <v-col cols="12">
    <h1>New Student</h1>

    <v-card class="pa-6">
      <v-col cols="12">
        <v-checkbox v-model="newStudent.invidual" label="invidual">
        </v-checkbox>
      </v-col>

      <v-row>
        <v-col cols="6">
          <v-text-field
            v-model="newStudent.firstName"
            label="Firstname"
            outlined
            required
          ></v-text-field>
        </v-col>

        <v-col cols="6">
          <v-text-field
            v-model="newStudent.lastName"
            label="Lastname"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12">
          <v-text-field
            v-model="newStudent.email"
            label="Email"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row class="mt-6 justify-end">
        <v-btn variant="text" @click="router.go(-1)">Cancel</v-btn>
        <v-btn color="primary" variant="outlined" @click="onStudentubmit"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
  </v-col>
</template>
