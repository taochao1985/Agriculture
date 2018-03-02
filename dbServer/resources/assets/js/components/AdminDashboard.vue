<template>
  <v-app id="inspire">
    <nav-component :drawer='drawer'></nav-component>
    <v-toolbar
      color="green darken-2"
      dark
      app
      :clipped-left="$vuetify.breakpoint.mdAndUp"
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <span class="hidden-sm-and-down">Google Contacts</span>
      </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        prepend-icon="search"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-speed-dial
      v-model="fab"
      direction="bottom"
      transition="slide-y-reverse-transition"
    >
      <v-btn
        slot="activator"
        color="blue darken-2"
        small
        dark
        fab
        hover
        v-model="fab"
      >
        <v-icon>account_circle</v-icon>
        <v-icon>close</v-icon>
      </v-btn>
      <v-btn
        fab
        dark
        small
        color="red"
        @click="logout"
      >
        <v-icon>edit</v-icon>
      </v-btn>

    </v-speed-dial>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
         <router-view/>
      </v-container>
    </v-content>
    <v-btn
      fab
      bottom
      right
      small
      color="green accent-4"
      dark
      fixed
      @click.stop="dialog = !dialog"
    >
      <v-icon>add</v-icon>
    </v-btn>
  </v-app>
</template>

<script>
  import navComponent from './common/Nav';
  import AuthenticationService from '../services/AuthenticationService';
  export default {
    components: {
      navComponent
    },
    data: () => ({
      dialog: false,
      drawer: true,
      fab: false
    }),
    methods: {
      async logout() {
        var response = await AuthenticationService.logout({
          _token:this._token
        })
        this.$store.dispatch('setToken', null)
        this.$store.dispatch('setUser', null)
        window.location.reload();
      }
    },
    props: ['_token']
  }
</script>
