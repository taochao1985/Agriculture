<template>
  <div>
    <top-menu v-if="condition"></top-menu>
    <router-view></router-view>
  </div>
</template>
<script>
  import {mapState} from 'vuex'
  import TopMenu from './components/TopMenu'

  export default {
    data () {
      return {
        condition: true
      }
    },
    components: {
      TopMenu
    },
    computed: {
      ...mapState({
        userStore: state => state.userStore
      })
    },
    created () {
      const userObj = JSON.parse(window.localStorage.getItem('authUser'))
      this.$store.dispatch('setUserObject', userObj)
    },
    sockets: {
      connect () {
        console.log('socket connected')
      }
    },
    mounted () {
      this.condition = this.$router.history.current.meta.pos !== 'usercenter'
    }
  }
</script>
