import Register from '../components/Register'
import Login from '../components/Login'
import Dashboard from '../components/Dashboard'
import CateList from '../components/pages/CateList'
export default {
  mode: 'hash',
  routes: [
    {
      path: '/',
      name: 'root',
      component: Dashboard
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
      path: '/catelist',
      name: 'catelist',
      component: CateList
    },
  ]
}
