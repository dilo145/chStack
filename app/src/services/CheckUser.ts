class CheckUser {
  //check in local storage if user is logged in

  isFormer(): boolean {
    let user = JSON.parse(localStorage.getItem('user') || '{}');
    if (user.roles?.includes('ROLE_FORMER')) {
      return true;
    }
    return false;
  }
  isStudent(): boolean {
    let user = JSON.parse(localStorage.getItem('user') || '{}');
    if (user.roles?.includes('ROLE_STUDENT')) {
      return true;
    }
    return false;
  }
  getId(): number {
    let user = JSON.parse(localStorage.getItem('user') || '{}');
    return user.id;
  }
  getUser() {
    let user = localStorage.getItem('user');

    if (user) {
      return JSON.parse(user);
    }

    return null;
  }
  isUserSet(): boolean {
    let user = localStorage.getItem('user');

    if (user) {
      return true;
    }

    return false;
  }
}

export default new CheckUser();
