export type RetourLogin = {
  error: string;
  data: {
    user: {
      lastName: string;
      firstName: string;
      email: string;
      photo: string;
    };
    message: string;
  };
};
