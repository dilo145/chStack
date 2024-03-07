export type Role = 'ROLE_FORMER' | 'ROLE_STUDENT';

export type Student = {
  id: number;
  invidual: boolean;
  registrations: any[];
  answer: any[];
  firstName: string;
  lastName: string;
  email: string;
  photo: string;
  userIdentifier: string;
  roles: Role[];
  password: string;
  createdAt: string;
  updatedAt: null | string;
  deletedAt: null | string;
  messagesSended: any[];
  messagesRecived: any[];
};
