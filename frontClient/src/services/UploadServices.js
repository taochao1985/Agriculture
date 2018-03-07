import Api from './Api'

export default {
  destory (data) {
    return Api().post('api/v1/file-destory', data)
  }
}
