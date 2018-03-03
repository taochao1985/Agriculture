<template>
  <v-app id="inspire">
    <alert-component :alertMessage="alertMessage"></alert-component>
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="green darken-2">
                <v-toolbar-title>ADMIN Login</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <input type="hidden" v-model="_token" name="_token"/>
                <v-text-field prepend-icon="person" name="email" label="Email" type="email" v-model="email"></v-text-field>
                <v-text-field prepend-icon="lock" name="password" label="Password" id="password" type="password" v-model="password"></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-2" dark @click="adminLogin">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import AuthenticationService from '../services/AuthenticationService';
  export default {
    data: () => ({
      drawer: null,
      email: '',
      password: '',
      alertMessage: ''
    }),
    props: ['_token'],
    methods: {
      async adminLogin () {
        try {
          var response = await AuthenticationService.login({
            email: this.email,
            password: this.password,
            _token:this._token
          })
          this.$store.dispatch('setToken', response.data.data.token)
          this.$store.dispatch('setUser', response.data.data.user)
          this.$store.dispatch('set_token', this._token)
          window.location.reload();
        } catch (error) {
          console.log(error)
          this.error = error.response.data.error
        }
      }
    }
  }
</script>
