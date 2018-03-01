<template>
  <v-list two-line>
    <template v-if='$store.state.isUserLoggedIn'>
      <v-text-field
            label="Comments"
            v-model="commentContent"
            xs8 sm6 offset-sm2
          ></v-text-field> 
            <v-btn color="primary" @click="saveComment" round dark >Publish</v-btn>
    </template>
    <template v-for="(item, index) in comments">
      <v-list-tile
        avatar
        ripple
        :key="item.id"
      >
        <v-list-tile-content>
          <v-list-tile-title>{{ item.content }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </template>
  </v-list>
</template>
 
<script>
import BlogsCommentsService from '@/services/BlogsCommentsService'
export default {
  data () {
    return {
      comments: [
      ],
      commentContent: ''
    }
  },
  methods: {
    async saveComment () {
      try {
        var comment = (await BlogsCommentsService.post({
          blogId: this.$store.state.route.params.blogId,
          userId: this.$store.state.user.id,
          content: this.commentContent
        })).data
        this.commentContent = ''
        this.comments.push(comment)
      } catch (error) {
        console.log(error)
      }
    }
  },
  async mounted () {
    var blogId = this.$store.state.route.params.blogId
    this.comments = (await BlogsCommentsService.index(blogId)).data
  }
}
</script>
<style scoped>
</style>