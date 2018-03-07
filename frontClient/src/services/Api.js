import axios from 'axios'

export default () => {
  const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
  const headers = {
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + tokenData.access_token
  }
  return axios.create({
    baseURL: `http://localhost:8000/`,
    headers
  })
}
