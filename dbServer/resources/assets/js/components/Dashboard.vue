<template>
  <div id="">
		<upload-component></upload-component>
    <editor-component></editor-component>
  </div>
</template>
<script>
import UploadComponent from './common/Upload';
import EditorComponent from './common/Editor';
export default {
  components: {
    UploadComponent,
    EditorComponent
  },
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
