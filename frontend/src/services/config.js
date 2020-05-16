import axios from 'axios'

export const http = axios.create({
  baseURL: 'http://localhost:8088/',
  headers: { Authorization: 123 },
  responseEncoding: 'utf8'
})
