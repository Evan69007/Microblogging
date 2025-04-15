import axios from 'axios';

const API_URL = "http://localhost:8000/api";

const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

export default {
  async getPosts() {
    const response = await api.get('/posts');
    console.log(" API reponse:", response.data); 
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

