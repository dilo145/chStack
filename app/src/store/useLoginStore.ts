import api from "@/services/WebService";
import { RetourLogin } from "@/types/retourLogin";
import { defineStore } from "pinia";
import { reactive } from "vue";
import { useRouter } from "vue-router";
export const useLoginStore = defineStore("login", () => {
  const newLogin = reactive<any>({
    email: "",
    password: "",
  });
  const show = reactive<any>({
    showMessage: false,
    showError: false,
    message: "",
  });
  const router = useRouter();
  function login() {
    //ash password before sending to server
    if (newLogin.password !== "" && newLogin.email !== "") {
      api.post<RetourLogin>("auth/login-user", newLogin).then((response) => {
        if (
          response.data !== undefined &&
          response.data.user !== undefined &&
          response.data.user !== undefined
        ) {
          localStorage.user = JSON.stringify(response.data.user);
          //add to html <v-alert text type="success">response.data.message</v-alert>
          show.showMessage = true;
          show.message = response.data.message;
          setTimeout(() => {
            router.push("/");
          }, 1500);
        }
        if (response.error !== undefined) {
          show.showError = true;
          show.message = response.error;
        }
      });
    }
  }
  return {
    newLogin,
    show,
    login,
  };
});
