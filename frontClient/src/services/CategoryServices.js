import Api from './Api'

export default {
  list () {
    return Api().get('api/v1/categories')
  }
}
