<template> 
  <v-toolbar fixed dark class='light-blue'>
    <v-toolbar-title>
      <router-link
        tag="span"
        :to="{
          name: 'root'
        }">
        TaoBlog
      </router-link>
    </v-toolbar-title>
    <v-toolbar-items>
      <v-btn flat :to="{
          name: 'blogs'
        }">
        Browse
      </v-btn>
    </v-toolbar-items>
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-btn flat :to="{
          name: 'login'
        }" v-if="!$store.state.isUserLoggedIn">
        Login
      </v-btn>
      <v-btn flat :to="{
          name: 'register'
        }" v-if="!$store.state.isUserLoggedIn">
        SIGH UP
      </v-btn>
      <v-btn flat :to="{
          name: 'login'
        }" v-if="$store.state.isUserLoggedIn">
        {{ $store.state.user.email }}
      </v-btn>
      <v-btn flat @click="logout()" v-if="$store.state.isUserLoggedIn">
        Log Out
      </v-btn>
    </v-toolbar-items>
  </v-toolbar>
</template>
 
<script>
export default {
  methods: {
    logout () {
      this.$store.dispatch('setToken', null)
      this.$store.dispatch('setUser', null)
    }
  }
}
</script>
<style type="text/css">
</style>