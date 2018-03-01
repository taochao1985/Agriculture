<template>
  <v-layout column >
      <v-flex xs6 offset-xs3 >
        <panel title="Create Blog">
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
          <upload-panel />
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
import UploadPanel from '@/components/globals/UploadPanel'
import BlogsService from '@/services/BlogsService'
export default {
  components: {
    UploadPanel
  },
  data () {
    return {
      blog: {
        title: '',
        author: '',
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
        var response = await BlogsService.post(this.blog)
        console.log(response)
      } catch (error) {
        this.error = error.response.data.error
      }
    }
  }
}
</script>
<style scoped>
</style>