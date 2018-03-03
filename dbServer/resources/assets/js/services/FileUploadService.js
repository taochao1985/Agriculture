import Api from './Api'

export default {
  upload (credentials) {

    Api().headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    return Api().post('upload', credentials)
  }
}
