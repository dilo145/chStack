import axios, { AxiosInstance, AxiosResponse } from "axios";

class WebService {
  private api: AxiosInstance;

  constructor() {
    this.api = axios.create({
      baseURL: "http://127.0.0.1:8000/api/", // your API base URL
      headers: {
        "Content-Type": "application/json",
      },
    });
  }

  async get<JSON>(path: string): Promise<JSON> {
    try {
      const response: AxiosResponse<JSON> = await this.api.get<JSON>(path);
      return response.data;
    } catch (error) {
      console.error("Error fetching data:", error);
      throw error;
    }
  }

  async create<JSON>(path: string, body: any): Promise<JSON> {
    try {
      const response: AxiosResponse<JSON> = await this.api.post<JSON>(
        path,
        JSON.stringify(body)
      );
      return response.data;
    } catch (error) {
      console.error("Error creating item:", error);
      throw error;
    }
  }

  async delete<JSON>(path: string, id: number): Promise<JSON> {
    try {
      const response: AxiosResponse<JSON> = await this.api.delete<JSON>(
        `${path}/${id}`
      );
      return response.data;
    } catch (error) {
      console.error("Error deleting item:", error);
      throw error;
    }
  }
}

export default new WebService();
