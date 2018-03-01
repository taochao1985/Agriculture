<template>
  <v-layout column >
      <v-flex xs10 offset-xs1 >
        <blog-search-panel />
        <panel title="Blogs">
          <v-btn slot="action" class="light-blue" small right absolute right fab :to="{
          name: 'create-blog'
        }">
            <v-icon>add</v-icon>
          </v-btn>
          <blog-list-panel />
        </panel>  
      </v-flex>
    </v-layout>
</template>
 
<script>
import BlogListPanel from '@/components/blog/BlogListPanel'
import BlogSearchPanel from '@/components/blog/BlogSearchPanel'
import BlogsService from '@/services/BlogsService'
export default {
  components: {
    BlogListPanel,
    BlogSearchPanel
  },
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