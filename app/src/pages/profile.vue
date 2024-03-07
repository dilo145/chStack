<script setup lang="ts">
import {onMounted, ref, toRefs} from 'vue'

import {useUserStore} from "@/store/useUserStore";
import { useFormerStore } from "@/store/useFormerStore";
const { user } = toRefs(useUserStore());
const userUserStore = useUserStore();
const role = userUserStore.getRole();
const color = ref('white')
const formerStore = useFormerStore();
const { editFormer, isEditing } = toRefs(formerStore);

onMounted(() => {
  if (role && role === 'ROLE_FORMER') {
    const id = user.value.id.toString();
    formerStore.getFormerById(id.toString());
  }
});

const disable = ref(false);
if (role && role === 'ROLE_STUDENT') {
  disable.value = true;
}


function submitForm() {
  formerStore.updateFormer(user.value.id.toString());
  isEditing.value = false;
  useUserStore().setPhoto(editFormer.value.photo);
  useUserStore().setEmail(editFormer.value.email);
  location.reload();
}
function resetForm() {
  // reset form logic here
}

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
              :src="user.photo"
            ></v-img>
          </div>
       </div>
      </v-card-item>
      <v-form v-if="user">
        <v-container>
          <v-row v-if="role && role === 'ROLE_FORMER'">

            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
                label="Email"
                v-model="editFormer.email"
                variant="outlined"
                :disabled="disable"
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              sm="6">
              <v-text-field
                type="password"
                density="compact"
                placeholder="Change your password"
                prepend-inner-icon="mdi-lock-outline"
                variant="outlined"
                v-model="editFormer.password"
                :disabled="disable"
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              sm="6">
              <v-text-field
                v-model="editFormer.photo"
                label="Url Logo"
                outlined
                :disabled="disable"
                prepend-icon="mdi-camera"
                required
              ></v-text-field>
            </v-col>

          </v-row>
          <v-row v-else >

            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
                label="Email"
                v-model="user.email"
                variant="outlined"
                :disabled="disable"
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              sm="6">
              <v-text-field
                type="password"
                density="compact"
                placeholder="Change your password"
                prepend-inner-icon="mdi-lock-outline"
                variant="outlined"
                v-model="user.password"
                :disabled="disable"
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
                :disabled="disable"
                v-model="user.photo"
              >
              </v-file-input>
            </v-col>

          </v-row>
        </v-container>
        <div class="d-flex justify-center ga-6 mb-8">
          <v-btn
            class="mt-4"
            color="#7649FF"
            @click="submitForm"
            :disabled="disable"
          >
            Enregistrer
          </v-btn>

          <v-btn
            class="mt-4"
            color="error"
            @click="reset"
            :disabled="disable"
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
