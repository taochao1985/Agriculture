import Api from './Api'

export default {
  add (credentials) {
    return Api().post('admin/categories/add', credentials)
  },
  update (credentials) {
    return Api().put('admin/categories/update/' + credentials.id, credentials)
  },
  list () {
    return Api().get('admin/categories')
  },
  delete (id) {
    return Api().delete('admin/categories/delete/' + id)
  }
}
