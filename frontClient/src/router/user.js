import Dashboard from '../pages/users/Dashboard'
import Profile from '../pages/users/Profile'
import Bids from '../pages/users/Bids'
export default {
  path: '/user/:id',
  component: Dashboard,
  children: [
    {
      name: 'profile',
      path: '/',
      component: Profile,
      meta: {
        title: '用户中心',
        pos: 'usercenter'
      }
    },
    {
      name: 'profile',
      path: 'profile',
      component: Profile,
      meta: {
        title: '用户中心',
        pos: 'usercenter'
      }
    },
    {
      name: 'bids',
      path: 'bids',
      component: Bids,
      meta: {
        title: '用户中心',
        pos: 'usercenter'
      }
    }
  ]
}
