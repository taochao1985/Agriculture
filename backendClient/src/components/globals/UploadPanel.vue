<template>
  <div>
    <vue-core-image-upload dark
      class="success btn pl-2 pr-2"
      :crop="false"
      v-model="data"
      @imageuploaded="imageuploaded"
      :max-file-size="5242880"
      :multiple="true"
      :multiple-size="4"
      url="http://localhost:8081/upload/post" >
    </vue-core-image-upload>
    </div>
</template>
<script>
import VueCoreImageUpload from '../../../node_modules/vue-core-image-upload/src/vue-core-image-upload.vue'
console.log(location.origin)
export default {
  components: {
    'vue-core-image-upload': VueCoreImageUpload
  },
  data () {
    return {
      data: []
    }
  },
  methods: {
    imageuploaded (res) {
      console.log(res)
    }
  }
}
</script>
<style scoped></style>