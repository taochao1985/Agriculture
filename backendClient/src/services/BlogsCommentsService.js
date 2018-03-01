import Api from '@/services/Api'

export default {
  index (blogId) {
    return Api().get(`comments/${blogId}`)
  },
  post (params) {
    return Api().post('comments', params)
  },
  delete (commentId) {
    return Api().delete(`comments/${commentId}`)
  }
}
