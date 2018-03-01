<template>
  <div id="app">
    <v-app>
      <page-header/>
      <main>
        <v-container>
          <router-view/>
        </v-container>
      </main>
    </v-app>

    <!-- <img src="./assets/logo.png"> -->

  </div>
</template>

<script>
import PageHeader from '@/components/Header'
export default {
  name: 'app',
  components: {
    PageHeader
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.container{
  margin: 0 auto;
}
</style>
