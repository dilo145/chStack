import api from "@/services/WebService";
import { User } from "@/types/User";
import { defineStore } from "pinia";
import {computed, onMounted, reactive, ref} from "vue";
import { useRouter } from "vue-router";

export const useUserStore = defineStore("user", () => {
    const users = ref<User[]>();
    const router = useRouter();

    const user = reactive<User>({
        firstName:"",
        lastName: "",
        email: "",
        photo: "",
        role: [],
    });
    const isUserSet = computed(() => user.firstName !== "");

    function setUser(localUser : User) {
        console.log(localUser);
        user.firstName = localUser.firstName;
        user.lastName = localUser.lastName;
        user.email = localUser.email;
        user.photo = localUser.photo;
        user.role = localUser.role;
        localStorage.setItem("user", JSON.stringify(user));
    }

    function getUser() {
        let localUser: string|null = localStorage.getItem("user");
        if (localUser !== null) {
            let parsedLocalUser : User = JSON.parse(localUser);
            user.firstName = parsedLocalUser.firstName;
            user.lastName = parsedLocalUser.lastName;
            user.email = parsedLocalUser.email;
            user.photo = parsedLocalUser.photo;
            user.role = parsedLocalUser.role;
        }
    }

    onMounted(() => {
        getUser();
    });

    return {
        user,
        setUser,
        getUser,
        isUserSet
    };
})
