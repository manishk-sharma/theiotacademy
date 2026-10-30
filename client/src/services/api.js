import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:5000',
  headers: {
    'Content-Type': 'application/json'
  }
});

export const submitEnquiry = async (formData) => {
  // Can accept FormData or JSON
  const isFormData = formData instanceof FormData;
  const config = isFormData ? { headers: { 'Content-Type': 'multipart/form-data' } } : {};
  const response = await api.post('/LiveLead/allenquiryldsubmit', formData, config);
  return response.data;
};

export const fetchHomeData = async () => {
  const response = await api.get('/api/home');
  return response.data;
};

export const fetchCourses = async () => {
  const response = await api.get('/api/courses');
  return response.data;
};

export default api;

