import HelloWorld from '@/components/HelloWorld'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Blogs from '@/components/blog/Blogs'
import CreateBlog from '@/components/blog/CreateBlog'
import ViewBlog from '@/components/blog/ViewBlog'
import EditBlog from '@/components/blog/EditBlog'

export default {
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'root',
      component: HelloWorld,
      meta: { requiresAuth: true }
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/blogs',
      name: 'blogs',
      component: Blogs,
      meta: { requiresAuth: true }
    },
    {
      path: '/blogs/create',
      name: 'create-blog',
      component: CreateBlog,
      meta: { requiresAuth: true }
    },
    {
      path: '/blogs/:blogId',
      name: 'blog',
      component: ViewBlog
    },
    {
      path: '/blogs/:blogId/edit',
      name: 'blog-edit',
      component: EditBlog
    }
  ]
}
