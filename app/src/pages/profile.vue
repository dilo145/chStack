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

