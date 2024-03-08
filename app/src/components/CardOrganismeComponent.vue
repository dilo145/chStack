<script setup lang="ts">
import router from '@/router';
import { useOrganismStore } from '@/store/useOrganismStore';
import { onMounted, toRefs } from 'vue';

const organismStore = useOrganismStore();

onMounted(() => {
  organismStore.getOrganisms();
});

const { Organisms: organisms } = toRefs(organismStore);
</script>
<template>
  <v-row class="my-5 mx-5 align-center"  justify="end">
    <v-btn class="w-auto" center color="primary" @click="router.push('/organisms/create')"> Create new organism </v-btn>
  </v-row>

  <v-list-item v-for="i in organisms" :key="i.id" v-if="organisms.length > 0">
    <v-hover
        v-slot="{ isHovering, props }"
    >
      <v-card
        :class="{ 'on-hover': isHovering }"
        :color="isHovering ? 'primary' : 'none'"
        @click="router.push('/organisms/' + i.id)"
        class="d-flex flex-column flex-sm-row gy-3 align-left border cursor-pointer pa-4"
        v-bind="props" enabled
      >
        <v-img :src="i.logo" class="" max-width="200" max-height="150" cover> </v-img>
        <div class="w-75">
          
          <v-card-subtitle class="d-flex flex-wrap justify-center h-25"> Organism</v-card-subtitle>
          <v-card-title class="d-flex flex-wrap justify-center text-center h-75" >{{ i.name }}</v-card-title>
        </div>
      </v-card>
    </v-hover>
  </v-list-item>
  <v-alert v-else>No organism found</v-alert>
</template>
