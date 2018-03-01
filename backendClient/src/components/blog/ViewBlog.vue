<template>
  <v-layout column >
      <v-flex xs12 sm6 offset-sm3>
        <panel title="BlogShow">
          <v-btn slot="action" class="light-blue" small right absolute right fab @click="navigatorTo({name: 'create-blog'})">
            <v-icon>add</v-icon>
          </v-btn>
          <v-card v-if="blog">
            <v-card-media
              class="white--text"
              height="200px"
              :src="blog.ablum"
            >
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox class="text-xs-left">
                    <span class="headline">{{ blog.title }}</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-media>
            <v-card-title>
              <div>
                <span class="grey--text">{{ blog.createdAt }}</span><br>
                {{ blog.description }}
              </div>
            </v-card-title>
          </v-card>
          <v-btn 
            v-if="isUserLoggedIn && !bookmark"
            color="primary" round small dark @click="setBookmark">
            Bookmark
          </v-btn>
          <v-btn 
            v-if="isUserLoggedIn && bookmark"
            color="warning" round  small dark @click="unSetBookmark">
            UnBookmark
          </v-btn>
            <blog-comments-panel  />
        </panel>  
      </v-flex>
    </v-layout>
</template>
 
<script>
import {mapState} from 'vuex'
import BookmarksService from '@/services/BookmarksService'
import BlogsService from '@/services/BlogsService'
import BlogCommentsPanel from '@/components/blog/BlogCommentsPanel'
export default {
  components: {
    BlogCommentsPanel
  },
  data () {
    return {
      blog: null,
      bookmark: null
    }
  },
  methods: {
    async setBookmark () {
      try {
        this.bookmark = (await BookmarksService.post({
          BlogId: this.blog.id,
          UserId: this.$store.state.user.id
        })).data
      } catch (error) {
        console.log(error)
      }
    },
    async unSetBookmark () {
      try {
        await BookmarksService.delete(this.bookmark.id)
        this.bookmark = null
      } catch (error) {
        console.log(error)
      }
    }
  },
  async mounted () {
    var blogId = this.$store.state.route.params.blogId
    this.blog = (await BlogsService.show(blogId)).data
    if (!this.isUserLoggedIn) {
      return
    }
    this.bookmark = (await BookmarksService.index({
      blogId: this.blog.id,
      userId: this.$store.state.user.id
    })).data
  },
  computed: {
    ...mapState([
      'isUserLoggedIn'
    ])
  }
}
</script>
<style scoped>
</style>