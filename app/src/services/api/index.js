import axios from 'axios'

const BASE_URL='http://localhost:8000';

const AXIOS_HEADERS = {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
}

const instance = axios.create({
  baseURL: BASE_URL,
  withCredentials: true,
  headers: AXIOS_HEADERS
});

instance.baseUrl = BASE_URL;

export default instance