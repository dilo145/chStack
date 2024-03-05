<script setup lang="ts">
import { ref } from 'vue'
const color = ref('white')
</script>

<template>
  <div class="mt-4">
    <h1>Mon Profil</h1>

    <v-card
      :color="color"
      class="bg-white mt-10"
      max-width="344"
    >
      <v-card-item>
        <div>
          <div class="text-h6 mb-1">
            <v-img
              class="w-50 rounded-"
              alt="Avatar"
              src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
            ></v-img>
          </div>
          <div class="text-caption">Greyhound divisely hello coldly fonwderfully</div>
        </div>
      </v-card-item>

      <v-card-actions>
        <v-btn>
          Button
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>

</template>

