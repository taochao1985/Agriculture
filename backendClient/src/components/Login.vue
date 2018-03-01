<template light> 
    <v-layout column >
      <v-flex xs6 offset-xs3 >
        <panel title="Login">
          <v-text-field
            label="Email"
            v-model="email"
            required
          ></v-text-field>
            <br>
            <v-text-field
            label="Password"
            type="password"
            v-model="password"
            required
          ></v-text-field>
            <br>
            <div class="error" v-html="error"></div>
            <v-btn color="primary" @click="login">LOGIN</v-btn>
        </panel>
      </v-flex>
    </v-layout>
</template>
 
<script>
import AuthenticationService from '@/services/AuthenticationService'
export default {
  data () {
    return {
      email: '',
      password: '',
      error: null
    }
  },
  methods: {
    async login () {
      try {
        var response = await AuthenticationService.login({
          email: this.email,
          password: this.password
        })

        this.$store.dispatch('setToken', response.data.token)
        this.$store.dispatch('setUser', response.data.user)
        this.$router.push({
          name: 'blogs'
        })
      } catch (error) {
        console.log(error)
        this.error = error.response.data.error
      }
    }
  }
}
</script>
<style scoped>
</style>