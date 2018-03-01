import Api from '@/services/Api'

export default {
  post (blogData) {
    return Api().post('blogs/post', blogData)
  }
}
