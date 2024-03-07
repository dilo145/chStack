import { User } from "@/types/User";
import { defineStore } from "pinia";
import { computed, onMounted, reactive, ref } from "vue";
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


    //function to remove the user from pinia
    function removeUser() {
        user.id = 0;
        user.firstName = "";
        user.lastName = "";
        user.email = "";
        user.photo = "";
        user.roles = [];
        localStorage.removeItem("user");
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

    function setPhoto(photo: string) {
        user.photo = photo;
        localStorage.setItem("user", JSON.stringify(user));
    }

    function setEmail(email: string) {
        user.email = email;
        localStorage.setItem("user", JSON.stringify(user));
    }

    function getRole(){
        return user.roles.length > 0 ? user.roles[0] : null;
    }

    onMounted(() => {
        getUser();
    });

    return {
        user,
        setUser,
        getUser,
        isUserSet,
        getRole,
        setPhoto,
        removeUser,
        setEmail
    };
})
