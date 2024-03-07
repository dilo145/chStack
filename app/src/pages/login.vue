<script setup lang="ts">
import { useFormerStore } from "@/store/useFormerStore";
import { onMounted, ref, toRefs } from "vue";
import { useRouter } from "vue-router";
import { useLoginStore } from "@/store/useLoginStore";
import router from "@/router";
const formerStore = useFormerStore();
const router = useRouter();

onMounted(() => {
});

const { newFormer } = toRefs(formerStore);

function onFormerSubmit() {
  formerStore.createFormer();
}

const loginStore = useLoginStore();
const { newLogin, show } = toRefs(loginStore);
function onLoginSubmit() {
  loginStore.login();
  // router.go(-1);
}

const emailRules: any = [
  (v: string) => !!v || "Email requiered",
  (v: string) => /.+@.+\..+/.test(v) || "Email must be valid",
];
const visible = ref(false);
const tab = ref(null);
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
        <v-alert v-show="show.showMessage" type="success">{{
          show.message
        }}</v-alert>
        <v-alert v-show="show.showError" color="red" type="error">{{
          show.message
        }}</v-alert>
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
                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field
                  density="compact"
                  type="email"
                  placeholder="Email address"
                  prepend-inner-icon="mdi-email-outline"
                  variant="outlined"
                  v-model="newLogin.email"
                  :rules="emailRules"
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
                  v-model="newLogin.password"
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
                  @click="onLoginSubmit"
                >
                  Connexion
                </v-btn>
              </v-window-item>

              <!-- Inscription -->

              <v-window-item value="two">
                <div class="text-subtitle-1 text-medium-emphasis">Nom</div>

                <v-text-field
                  density="compact"
                  placeholder="Nom"
                  variant="outlined"
                  v-model="newFormer.lastName"
                  required
                ></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis">Prenom</div>

                <v-text-field
                  density="compact"
                  placeholder="Prenom"
                  variant="outlined"
                  v-model="newFormer.firstName"
                  required
                ></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field
                  density="compact"
                  placeholder="Email address"
                  prepend-inner-icon="mdi-email-outline"
                  variant="outlined"
                  v-model="newFormer.email"
                  required
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
                  placeholder="Indiquer mot de passe"
                  prepend-inner-icon="mdi-lock-outline"
                  variant="outlined"
                  @click:append-inner="visible = !visible"
                  v-model="newFormer.password"
                  required
                ></v-text-field>

                <v-card
                  class="mb-6"
                  color="surface-variant"
                  variant="tonal"
                  required
                >
                </v-card>

                <v-btn
                  class="mb-8"
                  color="blue"
                  size="large"
                  variant="tonal"

                  block
                  @click="onFormerSubmit"
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
