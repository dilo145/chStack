import { Level } from "@/types/Level";

export type Lesson = {
  id: number;
  title: string;
  description: string;
  goal: Level;
  time: string;
  place: string;
};
