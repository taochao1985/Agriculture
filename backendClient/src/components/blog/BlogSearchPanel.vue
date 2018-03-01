<template>
  <div>
    <v-text-field
      label="Search Author Title Description"
      v-model="search"
    ></v-text-field>
  </div>
</template>
<script>
import _ from 'lodash'
export default {
  data () {
    return {
      search: ''
    }
  },
  watch: {
    search: _.debounce(async function (value) {
      var route = {
        name: 'blogs'
      }
      if (this.search !== '') {
        route.query = {
          search: this.search
        }
      }
      this.$router.push(route)
    }, 700),
    '$route.query.search': {
      immediate: true,
      handler (value) {
        this.search = value
      }
    }
  }
}
</script>
<style scoped></style>