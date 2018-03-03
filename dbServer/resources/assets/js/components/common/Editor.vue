<template>
   <div id="app">
		 <vue-editor
			v-model="content"></vue-editor>
   </div>
 </template>

 <script>
   import { VueEditor } from 'vue2-editor'

   export default {

   components: {
      VueEditor
   },

   data() {
       return {
				 content: 'base on wangeditor'
       }
     }
   }
 </script>
