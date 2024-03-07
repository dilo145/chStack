class CheckUser {
  //check in local storage if user is logged in

  isFormer() {
    let user = JSON.parse(localStorage.getItem("user") || "{}");
    if (user.roles.includes("ROLE_FORMER")) {
      return true;
    }
    return false;
  }
  isStudent() {
    let user = JSON.parse(localStorage.getItem("user") || "{}");
    if (user.roles.includes("ROLE_STUDENT")) {
      return true;
    }
    return false;
  }
  getId() {
    let user = JSON.parse(localStorage.getItem("user") || "{}");
    return user.id;
  }


}

export default new CheckUser();
