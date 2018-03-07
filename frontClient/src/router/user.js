import Dashboard from '../pages/users/Dashboard'
import Profile from '../pages/users/Profile'
import Bids from '../pages/users/Bids'
import BidCreate from '../pages/users/BidForm'
export default {
  path: '/user/',
  component: Dashboard,
  children: [
    {
      name: 'profile',
      path: 'profile',
      component: Profile,
      meta: {
        title: '用户中心',
        pos: 'usercenter',
        link_name: 'profile'
      }
    },
    {
      name: 'bids',
      path: 'bids',
      component: Bids,
      meta: {
        title: '用户中心',
        pos: 'usercenter',
        link_name: 'bids'
      }
    },
    {
      name: 'createbids',
      path: 'bids/add',
      component: BidCreate,
      meta: {
        title: '用户中心',
        pos: 'usercenter',
        link_name: 'bids'
      }
    },
    {
      name: 'editbids',
      path: `bids/add/:id`,
      component: BidCreate,
      meta: {
        title: '用户中心',
        pos: 'usercenter',
        link_name: 'bids'
      }
    }
  ]
}
