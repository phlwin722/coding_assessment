import axios from "axios";

const axiosClient = axios.create({
    baseURL: 'http://127.0.0.1:8000/api'
})

axiosClient.interceptors.request.use((config) => {
    const token = localStorage.getItem('access_token');

    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config;
});

axiosClient.interceptors.request.use((response) => {
    return response;
}, (error) => {
    try {
        if (error.response.status === 401) {
            localStorage.removeItem('access_token');
            window.location.href='signin'
        }
    } catch (error) {
        console.log(error)
    }
    throw error;
})

export default axiosClient;