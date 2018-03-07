import Api from './Api'

export default {
  list () {
    return Api().get('api/v1/bids/list')
  },
  add (formData) {
    return Api().post('api/v1/bids/store', formData)
  },
  update (formData) {
    return Api().post(`api/v1/bids/update/${formData.id}`, formData)
  },
  show (id) {
    return Api().get(`api/v1/bids/show/${id}`)
  },
  delete (id) {
    return Api().post(`api/v1/bids/delete/${id}`)
  }
}
