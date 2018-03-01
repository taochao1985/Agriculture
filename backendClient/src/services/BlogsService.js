import Api from '@/services/Api'

export default {
  index (search) {
    return Api().get('blogs', {
      params: {
        search: search
      }
    })
  },
  post (blogData) {
    return Api().post('blogs/post', blogData)
  },
  show (blogId) {
    return Api().get(`blogs/${blogId}`)
  },
  put (blog) {
    return Api().put(`blogs/${blog.id}`, blog)
  },
  delete (blog) {
    return Api().delete(`blogs/${blog.id}`)
  }

}
