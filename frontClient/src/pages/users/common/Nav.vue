<template>
  <div class="col-sm-2 col-md-2 sidebar">
		<ul class="nav nav-sidebar" v-for="item in items">
      <li>
        <h4><strong>{{ item.name }}</strong></h4>
        <ul v-if="item.children" class="nav nav-sidebar">
          <template v-for="link in item.children">
            <li class="active" v-if="link.name == currentPath">
              <a :href="link.path">{{ link.label }}</a>
            </li>
            <li v-else>
              <a :href="link.path">{{ link.label }}</a>
            </li>
          </template>
        </ul>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name: '',
  data: () => ({
    currentPath: '',
    items: [
      {
        path: '/',
        name: '个人设置',
        children: [
          {
            path: '/user/profile',
            name: 'profile',
            label: '个人店铺'
          },
          {
            path: '/user/bids',
            name: 'bids',
            label: '竞拍列表'
          }
        ]
      }
    ]
  }),
  created () {
    this.currentPath = this.$router.history.current.meta.link_name
  }
}
</script>
<style lang="scss" scoped>
  .sidebar{
    background: #f4f6f7;
    box-shadow: 3px 0 6px rgba(0,0,0,.24);
    padding-right: 0;
    ul{
      margin-left: 15px;
      li {
        a{
          color:#000;
        }
      }
    }
    .active{
      border-right: 5px solid #388E3C;
      a {
        color: #43A047;
      }
    }
  }
</style>
