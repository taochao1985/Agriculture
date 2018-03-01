<template>
  <v-data-table
              v-bind:headers="headers"
              :items="blogs"
              class="elevation-1"
            >
  <template slot="headerCell" slot-scope="props">
    <v-tooltip bottom>
      <span slot="activator">
        {{ props.header.text }}
      </span>
      <span>
        {{ props.header.text }}
      </span>
    </v-tooltip>
  </template>
  <template slot="items" slot-scope="props">
    <td class="text-xs-center">{{ props.item.id }}</td>
    <td class="text-xs-center">{{ props.item.title }}</td>
    <td class="text-xs-center">{{ props.item.author }}</td>
    <td class="text-xs-right">
      <v-btn color="success" round fab dark small :to="{
          name: 'blog',
          params: { blogId: props.item.id}
        }">
        <v-icon>search</v-icon>
      </v-btn>
      <v-btn color="primary" round fab small :to="{
          name: 'blog-edit',
          params: { blogId: props.item.id}
        }">
        <v-icon>edit</v-icon>
      </v-btn>
      <v-btn color="red" round fab small dark @click="deleteBlog({ id: props.item.id })">
        <v-icon>delete</v-icon>
      </v-btn>
    </td>
  </template>
</v-data-table>
</template>
 
<script>
import BlogsService from '@/services/BlogsService'
export default {
  data () {
    return {
      blogs: [],
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Title', value: 'title' },
        { text: 'Author', value: 'author' },
        { text: 'Detail', value: 'author' }
      ]
    }
  },
  watch: {
    '$route.query.search': {
      immediate: true,
      async handler (value) {
        this.blogs = (await BlogsService.index(value)).data
      }
    }
  },
  methods: {
    async deleteBlog (param) {
      try {
        await BlogsService.delete(param)
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
</style>