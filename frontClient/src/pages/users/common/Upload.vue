<template>
  <div>
    <file-upload
       class="btn btn-success" 
       extensions="gif,jpg,jpeg,png,webp"
       accept="image/png,image/gif,image/jpeg,image/webp"
       :multiple="true"
       :post-action="uploadDomain"
       :headers="headers"
       :size="1024 * 1024 * 10"
       @input-filter="inputFilter"
       @input-file="inputFile"
       v-model="files"
       ref="upload">
       请选择
    </file-upload>
    <ul class="img-ul">
      <li v-for="(file, key) in files" v-if="attachments[key]">
        <img :src="apiDomain+attachments[key]">
        <span class="glyphicon glyphicon-remove" aria-hidden="true" @click="remove(file)"></span>
      </li>
    </ul>
  </div>
</template>
<script>
import FileUpload from 'vue-upload-component'
import {apiDomain} from '../../../config'
import UploadServices from '../../../services/UploadServices'

export default {
  components: {
    FileUpload
  },
  created () {
    const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
    this.headers = {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + tokenData.access_token
    }
  },
  data () {
    return {
      uploadDomain: apiDomain + 'api/v1/file-upload',
      apiDomain,
      files: [],
      attachments: [],
      headers: {}
    }
  },
  methods: {
    remove (file) {
      this.$refs.upload.remove(file)
    },
    inputFilter (newFile, oldFile, prevent) {
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
    inputFile (newFile, oldFile) {
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
          if (newFile.response.code === 0) {
            this.attachments.push(newFile.response.data.src)
            this.$emit('fileUploaded', {
              src: newFile.response.data.src,
              type: 'add'
            })
          } else {
            this.$notify({
              type: 'danger',
              title: '上传错误!',
              content: newFile.response.msg
            })
          }
        }
      }
      if (!newFile && oldFile) {
        // remove
        if (oldFile.success && oldFile.response.data.src) {
          UploadServices.destory({
            src: oldFile.response.data.filename
          })
          this.$emit('fileUploaded', {
            src: oldFile.response.data.src,
            type: 'delete'
          })
        }
      }
      // Automatically activate upload
      if (Boolean(newFile) !== Boolean(oldFile) || oldFile.error !== newFile.error) {
        if (!this.$refs.upload.active) {
          this.$refs.upload.active = true
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .accent-4{
    color: #fff;
    font-weight: bold;
    cursor: pointer;
  }
  .img-ul{
    padding: 0;
    margin-top: 20px;
    li {
      display: inline-block;
      margin-right:15px;
      list-style-type: none;
      img{
        width: 100px;
        max-height: 100px;
      } 
      span {
          color: red;
          cursor: pointer;
          position: absolute;
          margin-top: 45px;
          margin-left: 92px;
        }
    }  
  }
</style>
