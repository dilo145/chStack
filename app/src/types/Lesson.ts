import { Category } from "@/types/Category";
import { Level } from "@/types/Level";

export type Lesson = {
  id: number;
  title: string;
  description: string;
  goal: string;
  place: string;
  level: Level;
  category: Category[];
};
