<script setup lang="ts">
import { useOrganismStore } from "@/store/useOrganismStore";
import { computed, onMounted, toRefs } from "vue";
import { useRouter } from "vue-router";
import ClassIndex from "@/pages/classes/index.vue";
const OrganismStore = useOrganismStore();

const id = computed(() => {
  return router.currentRoute.value.params.id;
});

const router = useRouter();

function onEditOrganism() {
  OrganismStore.updateOrganism(id.value.toString());
  isEditing.value = false;
}

onMounted(() => {
  const id = router.currentRoute.value.params.id;

  OrganismStore.getOrganism(id.toString());
});

const { editOrganism, isEditing } = toRefs(OrganismStore);
</script>

<template>
  <v-col cols="12">
    <h1>Organism detail page</h1>

    <v-btn
      v-if="!isEditing"
      @click="isEditing = true"
      color="primary"
      class="mb-6"
    >
      <v-icon icon="mdi-pencil"> </v-icon>
      Edit</v-btn
    >

    <v-card class="pa-6">
      <v-text-field
        v-model="editOrganism.name"
        :disabled="!isEditing"
        label="Name"
        outlined
        required
      ></v-text-field>

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="editOrganism.logo"
            :disabled="!isEditing"
            label="Url Logo"
            outlined
            required
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row class="mt-6 justify-end">
        <v-btn
          variant="text"
          @click="
            router.go(-1);
            isEditing = false;
          "
          >Cancel</v-btn
        >
        <v-btn
          color="primary"
          variant="outlined"
          @click="onEditOrganism"
          :disabled="!isEditing"
          >Submit</v-btn
        >
      </v-row>
    </v-card>
    <class-index :from-organism="true" :liste-from-organism="editOrganism.trainings" ></class-index>
  </v-col>
</template>
