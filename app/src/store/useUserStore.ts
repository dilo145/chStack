import api from "@/services/WebService";
import { User } from "@/types/User";
import { defineStore } from "pinia";
import {computed, onMounted, reactive, ref} from "vue";
import { useRouter } from "vue-router";

export const useUserStore = defineStore("user", () => {
    const users = ref<User[]>();
    const router = useRouter();

    const user = reactive<User>({
        id: 0,
        firstName:"",
        lastName: "",
        email: "",
        photo: "",
        roles: [],
    });
    const isUserSet = computed(() => user.firstName !== "");

    function setUser(localUser : User) {
        user.id = localUser.id;
        user.firstName = localUser.firstName;
        user.lastName = localUser.lastName;
        user.email = localUser.email;
        user.photo = localUser.photo;
        user.roles = localUser.roles;
        localStorage.setItem("user", JSON.stringify(user));
    }

    function getUser() {
        let localUser: string|null = localStorage.getItem("user");
        if (localUser !== null) {
            let parsedLocalUser : User = JSON.parse(localUser);
            user.id = parsedLocalUser.id;
            user.firstName = parsedLocalUser.firstName;
            user.lastName = parsedLocalUser.lastName;
            user.email = parsedLocalUser.email;
            user.photo = parsedLocalUser.photo;
            user.roles = parsedLocalUser.roles;
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
