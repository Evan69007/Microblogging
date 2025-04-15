import axios from 'axios';

const API_URL = "http://localhost:8000/api";

const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

// Ajout du token dans les headers par défaut si disponible
const token = JSON.parse(sessionStorage.getItem('access_token'));
if (token?.access_token) {
  api.defaults.headers.common['Authorization'] = `Bearer ${token.access_token}`;
}

export default {
  async getUser() {
    const response = await api.get('/user');
    return response.data;
  },

  async getPosts() {
    const response = await api.get('/posts');
    return response.data;
  },

  async createPost(postData) {
    const response = await api.post('/posts', postData);
    return response.data;
  },

  async updatePost(id, postData) {
    const response = await api.put(`/posts/${id}`, postData);
    return response.data;
  },

  async deletePost(id) {
    const response = await api.delete(`/posts/${id}`);
    return response.data;
  }
};
