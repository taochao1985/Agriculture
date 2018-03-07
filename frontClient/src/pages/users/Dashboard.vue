<template>
  <div id="">
    <user-header></user-header>
    <div class="container">
      <div class="row">
        <user-nav></user-nav>
        <div class="col-sm-10 col-md-10 user-canvas">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import UserHeader from './common/Header'
import UserNav from './common/Nav'
export default {
  components: {
    UserHeader,
    UserNav
  },
  name: '',
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
  .user-canvas{
    padding-left: 50px;
  }
</style>
