<script setup lang="ts">
import WebService from "@/services/WebService";
import { ref } from "vue";

const visible = ref(false);
const tab = ref(null);
const loginData = ref({
  email: "",
  password: "",
});
const login = async () => {
  try {
    const response = await WebService.post<any>("auth/login-user ", loginData); // Await the response directly
    let jsonData = response; // Extract the JSON data from the response
    console.log(jsonData.firstName);
  } catch (error) {
    console.error("Error fetching data:", error);
    // Handle errors here
  }
};
</script>

<template>
  <div class="d-flex flex-lg-row flex-column h-screen w-100">
    <v-row justify="center" class="d-flex align-center">
      <v-col cols="12" md="8" lg="4">
        <!-- Ajustez selon le besoin -->
        <img
          src="../assets/logo.svg"
          style="width: 100%; max-width: 450px"
          alt=""
        />
      </v-col>
    </v-row>

    <v-row justify="center" class="content d-flex align-center">
      <v-col cols="12" md="8" lg="6">
        <!-- Ajustez selon le besoin -->
        <v-card
          class="mx-auto pa-12 pb-8"
          elevation="8"
          max-width="448"
          rounded="lg"
        >
          <v-tabs
            v-model="tab"
            bg-color="#f3efff"
            class="d-flex justify-center"
          >
            <v-tab value="one">Connexion</v-tab>
            <v-tab value="two">Inscription</v-tab>
          </v-tabs>

          <v-card-text>
            <v-window v-model="tab">
              <v-window-item value="one">
                <v-form @submit.prevent="login()">
                  <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                  <v-text-field
                    density="compact"
                    placeholder="Email address"
                    prepend-inner-icon="mdi-email-outline"
                    variant="outlined"
                    value="{{ loginData.email }}"
                  ></v-text-field>

                  <div
                    class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
                  >
                    Mot de passe
                  </div>

                  <v-text-field
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"
                    density="compact"
                    value="{{ loginData.password }}"
                    placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline"
                    variant="outlined"
                    @click:append-inner="visible = !visible"
                  ></v-text-field>

                  <v-card class="mb-6" color="surface-variant" variant="tonal">
                  </v-card>

                  <v-btn
                    class="mb-8"
                    color="blue"
                    size="large"
                    variant="tonal"
                    block
                  >
                    Connexion
                  </v-btn>
                </v-form>
              </v-window-item>
              <v-window-item value="two">
                <div class="text-subtitle-1 text-medium-emphasis">Nom</div>

                <v-text-field
                  density="compact"
                  placeholder="Nom"
                  variant="outlined"
                ></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis">Prenom</div>

                <v-text-field
                  density="compact"
                  placeholder="Prenom"
                  variant="outlined"
                ></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field
                  density="compact"
                  placeholder="Email address"
                  prepend-inner-icon="mdi-email-outline"
                  variant="outlined"
                ></v-text-field>

                <div
                  class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
                >
                  Mot de passe
                </div>

                <v-text-field
                  :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                  :type="visible ? 'text' : 'password'"
                  density="compact"
                  placeholder="Enter your password"
                  prepend-inner-icon="mdi-lock-outline"
                  variant="outlined"
                  @click:append-inner="visible = !visible"
                ></v-text-field>

                <v-card class="mb-6" color="surface-variant" variant="tonal">
                </v-card>

                <v-btn
                  class="mb-8"
                  color="blue"
                  size="large"
                  variant="tonal"
                  block
                >
                  Inscription
                </v-btn>
              </v-window-item>
            </v-window>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<style scoped>
.content {
  background-color: #f3efff;
  margin-top: 0px;
}
</style>
