import Api from './Api'

export default {
  register (credentials) {
    return Api().post('register', credentials)
  },
  logout (credentials) {
    return Api().post('logout', credentials)
  },
  login (credentials) {
    return Api().post('admin/login', credentials)
  }
}
