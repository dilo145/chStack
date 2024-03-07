<script setup lang="ts">
import { useUserStore } from '@/store/useUserStore';
import { ref, toRefs } from 'vue';

const drawer = ref(true);
const rail = ref(true);
const { user } = toRefs(useUserStore());
const userUserStore = useUserStore();
const role = userUserStore.getRole();

function disconnectUser() {
  localStorage.removeItem('user');
  // remove the user in pinia
  useUserStore().removeUser();
  location.reload();
}
</script>

<template>
  <!-- Conditional rendering of JSON data -->
  <v-card>
    <v-layout>
      <v-navigation-drawer v-model="drawer" :rail="rail" permanent @click="rail = false">
        <v-divider></v-divider>

        <v-img v-if="!rail" src="../assets/logo.png" class="ma-2 w-50 mb-4"></v-img>
        <v-img v-if="rail" src="../assets/small-logo.png" class="w-50 mx-auto ma-2"></v-img>
        <v-list density="compact" nav>
          <v-list-item
            link
            to="/calendar"
            prepend-icon="mdi-school"
            title="Calendrier"
            value="calendrier"
            v-if="role && role === 'ROLE_STUDENT'"
          ></v-list-item>
          <v-list-item
            link
            to="/"
            prepend-icon="mdi-account-group"
            title="Organisms"
            value="organisms"
            v-if="role && role === 'ROLE_FORMER'"
          ></v-list-item>
          <v-list-item link to="/lessons" prepend-icon="mdi-school" title="Cours" value="lessons"></v-list-item>
          <v-list-item
            link
            to="/classes"
            prepend-icon="mdi-school"
            title="Classes"
            value="classes"
            v-if="role && role === 'ROLE_FORMER'"
          ></v-list-item>
          <v-list-item
            link
            to="/graduation"
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
            v-if="role && role === 'ROLE_FORMER'"
          ></v-list-item>
          <v-list-item link to="/profile" prepend-icon="mdi-account" title="Mon Compte" value="account"></v-list-item>
        </v-list>

        <template v-slot:append v-if="user">
          <v-col v-if="!rail" cols="12">
            <v-btn color="error" variant="outlined" @click="disconnectUser" block>
              <v-icon icon="mdi-logout"></v-icon>
              Logout
            </v-btn>
          </v-col>

          <div class="pa-2" v-if="!rail && user.photo !== null">
            <v-list-item :prepend-avatar="user.photo" :title="`${user.firstName} ${user.lastName}`" nav>
              <div style="font-size: 12px">{{ role }}</div>
              <template v-slot:append>
                <v-btn icon="mdi-chevron-left" variant="text" @click.stop="rail = !rail"></v-btn>
              </template>
            </v-list-item>
          </div>
          <div class="pa-2" v-else>
            <v-list-item
              prepend-avatar="https://i1.sndcdn.com/avatars-000103501656-iji6a5-t500x500.jpg"
              :title="`${user.firstName} ${user.lastName}`"
              nav
            >
              <template v-slot:append>
                <v-btn icon="mdi-chevron-left" variant="text" @click.stop="rail = !rail"></v-btn>
              </template>
            </v-list-item>
          </div>
        </template>
      </v-navigation-drawer>
      <v-main style="height: 100vh"></v-main>
    </v-layout>
  </v-card>
</template>
