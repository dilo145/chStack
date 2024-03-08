export type RetourLogin = {
  error: string;
  data: {
    user: {
      id: number;
      lastName: string;
      firstName: string;
      email: string;
      photo: string;
      role: [];
    };
    message: string;
  };
};
