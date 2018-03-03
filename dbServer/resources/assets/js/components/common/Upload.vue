<template>
	<file-upload
		 class="btn green accent-4" 
		 extensions="gif,jpg,jpeg,png,webp"
		 accept="image/png,image/gif,image/jpeg,image/webp"
		 :multiple="true"
     post-action="/upload"
     :headers="headers"
		 :size="1024 * 1024 * 10"
		 v-model="files"
		 @input-filter="inputFilter"
		 @input-file="inputFile"
		 ref="upload">
		 请选择
	</file-upload>
</template>
<script>
import FileUpload from 'vue-upload-component'
export default {
  components: {
    FileUpload,
  },
  data() {
    return {
      files: [],
      headers: {
        'X-Csrf-Token': this.$store.state._token,
      }
    }
  },
  methods: {
    inputFilter(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        // Before adding a file
        // 添加文件前
        // Filter system files or hide files
        // 过滤系统文件 和隐藏文件
        if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
          return prevent()
        }
        // Filter php html js file
        // 过滤 php html js 文件
        if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
          return prevent()
        }
      }
    },
		// add, update, remove File Event
	 inputFile(newFile, oldFile) {
		 if (newFile && oldFile) {
			 // update
			 if (newFile.active && !oldFile.active) {
				 // beforeSend
				 // min size
				 if (newFile.size >= 0 && this.minSize > 0 && newFile.size < this.minSize) {
					 this.$refs.upload.update(newFile, { error: 'size' })
				 }
			 }
			 if (newFile.progress !== oldFile.progress) {
				 // progress
			 }
			 if (newFile.error && !oldFile.error) {
				 // error
			 }
			 if (newFile.success && !oldFile.success) {
				 // success
			 }
		 }
		 if (!newFile && oldFile) {
			 // remove
			 if (oldFile.success && oldFile.response.id) {
				 // $.ajax({
				 //   type: 'DELETE',
				 //   url: '/upload/delete?id=' + oldFile.response.id,
				 // })
			 }
		 }
		 // Automatically activate upload
		 if (Boolean(newFile) !== Boolean(oldFile) || oldFile.error !== newFile.error) {
			 if (!this.$refs.upload.active) {
				 this.$refs.upload.active = true
			 }
		 }
	 },
  }
}
</script>

<style lang="scss" scoped>
  .accent-4{
    color: #fff;
    font-weight: bold;
    cursor: pointer;
  }
</style>
