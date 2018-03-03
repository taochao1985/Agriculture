import user from './user'
import DashboardPage from '../pages/DashboardPage'
import ChatPage from '../pages/ChatPage'
import ForgotPassword from '../pages/ForgotPassword'
import ResetPassword from '../pages/ResetPassword'

import PrivateMessageInbox from '../components/private-message/PrivateMessageInbox'
import PrivateMessageSent from '../components/private-message/PrivateMessageSent'
import PrivateMessageView from '../components/private-message/PrivateMessageView'
import PrivateMessageCompose from '../components/private-message/PrivateMessageCompose'

export default {
  mode: 'history',
  routes: [
    user,
    {
      path: '/forgot-password',
      component: ForgotPassword,
      name: 'forgot-password'
    },
    {
      path: '/reset-password/:token',
      component: ResetPassword,
      name: 'reset-password'
    },
    {
      path: '/dashboard',
      component: DashboardPage,
      name: 'dashboard',
      meta: {
        requiresAuth: true,
        title: '主页'
      }
    },
    {
      path: '/chat',
      component: ChatPage,
      name: 'chat',
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/new-pm',
      component: PrivateMessageCompose,
      name: 'new-pm',
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/inbox-pms',
      component: PrivateMessageInbox,
      name: 'my-pms',
      meta: {
        requiresAuth: true,
        title: ''
      }
    },
    {
      path: '/pms/:pmId',
      component: PrivateMessageView,
      name: 'pm-view',
      meta: {
        requiresAuth: true,
        title: ''
      }
    },
    {
      path: '/sent-pms',
      component: PrivateMessageSent,
      name: 'my-pms-sent',
      meta: {
        requiresAuth: true,
        title: '首页'
      }
    }
  ]
}
