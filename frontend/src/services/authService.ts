import api from "../api/axios";

export interface LoginPayload {
  email: string;
  password: string;
}

export const login = async (payload: LoginPayload) => {
  const response = await api.post("/login", payload);
  return response.data;
};