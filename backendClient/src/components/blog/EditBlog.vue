<template>
  <v-layout column >
      <v-flex xs6 offset-xs3 >
        <panel title="Edit Blog">
          <form>
          <v-text-field
            label="Title"
            v-model="blog.title"
            required
            :rules="[required]"
          ></v-text-field>
            <br>
            <v-text-field
            label="Author"
            v-model="blog.author"
            required
            :rules="[required]"
          ></v-text-field>
          <v-text-field
            label="Ablum"
            v-model="blog.ablum"
            required
            :rules="[required]"
          ></v-text-field>
          <v-text-field
            label="Description"
            v-model="blog.description"
            multi-line
            required
            :rules="[required]"
          ></v-text-field>
            <br>
            <div class="error" v-if="error">{{error}}</div>
            <v-btn color="primary" @click="save" round dark >Save</v-btn>
          </form>  
        </panel>  
      </v-flex>
    </v-layout>
</template>
 
<script>
import BlogsService from '@/services/BlogsService'
export default {
  data () {
    return {
      blog: {
        title: '',
        author: '',
        ablum: '',
        description: ''
      },
      required: (value) => !!value || 'Required.',
      error: null
    }
  },
  methods: {
    async save () {
      var areaAllFieldsFilledIn = Object
        .keys(this.blog)
        .every(key => this.blog[key])

      if (!areaAllFieldsFilledIn) {
        this.error = 'some fields are required'
        return
      }

      try {
        await BlogsService.put(this.blog)
        this.$router.push({
          name: 'blogs'
        })
      } catch (error) {
        this.error = error.response.data.error
      }
    }
  },
  async mounted () {
    var blogId = this.$store.state.route.params.blogId
    this.blog = (await BlogsService.show(blogId)).data
  }
}
</script>
<style scoped>
</style>