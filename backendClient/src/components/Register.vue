<template light> 
    <v-layout column >
      <v-flex xs6 offset-xs3 >
        <panel title="Register">
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
            <div class="cyan" v-html="error"></div>
            <v-btn color="primary" @click="register">Register</v-btn>
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
    async register () {
      try {
        var response = await AuthenticationService.register({
          email: this.email,
          password: this.password
        })

        this.$store.dispatch('setToken', response.data.token)
        this.$store.dispatch('setUser', response.data.user)
        this.$router.push({
          name: 'blogs'
        })
      } catch (error) {
        this.error = error.response.data.error
      }
    }
  }
}
</script>
<style scoped>
  .error{
    color: red;
  } 
</style>