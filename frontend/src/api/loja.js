import axios from 'axios'

const baseURL = 'http://localhost:8088/'
const token = 123
const http = axios.create({
    baseURL: baseURL,
    headers: {
        Authorization: token
    },
    responseEncoding: 'utf8',
    responseType: 'json'
})

export { baseURL, http }
