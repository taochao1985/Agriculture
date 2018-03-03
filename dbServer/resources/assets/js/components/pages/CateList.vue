<template>
  <div class="container fluid">
    <v-dialog v-model="dialog" max-width="500px">
      <v-btn color="green accent-4" dark slot="activator" small><v-icon>add</v-icon></v-btn>
      <v-card>
        <v-form>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm12 md12>
                  <v-text-field
                    v-model="editedItem.name"
                    label="分类名"
                    :counter="10"
                    :error-messages="errors.collect('name')"
                    v-validate="'required|max:10'"
                    data-vv-name="name"
                    required
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="normal darken-1"  @click.native="close">Cancel</v-btn>
            <v-btn color="green darken-1" dark @click.native="save">Save</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
    
    <v-data-table
      :headers="headers"
      :items="items"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="justify-left layout px-0">
          <v-btn icon class="mx-0" @click="editItem(props.item)">
            <v-icon color="teal">edit</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="deleteItem(props.item)">
            <v-icon color="pink">delete</v-icon>
          </v-btn>
        </td>
      </template>
      <template slot="no-data">
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>

    <v-dialog v-model="deleteDialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">删除提示</v-card-title>
        <v-card-text>您确定要删除该分类吗？</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="default darken-1"  @click.native="deleteDialog = false">取消</v-btn>
          <v-btn color="red darken-1" dark @click.natvie="destroy">确定</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </div>
</template>
<script>
import CategoriesService from '../../services/CategoriesService';

export default {
  $_veeValidate: {
    validator: 'new'
  },
  data: () => ({
    dialog: false,
    deleteDialog: false,
    deleteId: 0,
    deleteIndex: 0,
    headers: [
      {
        text: 'ID',
        align: 'left',
        sortable: true,
        value: 'id'
      },
      { text: '分类名', value: 'name' },
      { text: '操作', value: 'id', sortable: false }
    ],
    items: [],
    editedIndex: -1,
    editedItem:{
      name: '',
      id: 0
    },
    defaultItem:{
      name: '',
      id: 0
    }
  }),
  dictionary: {
    custom: {
      name: {
        required: () => 'Name can not be empty',
        max: 'The name field may not be greater than 10 characters'
        // custom messages
      }
    }
  },
  mounted () {
    this.$validator.localize('en', this.dictionary)
  },
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? '新增' : '编辑'
    }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  created () {
    this.initialize()
  },

  methods: {
    async initialize () {
      var response = await CategoriesService.list();
      if ( response.data.code == 0 ){
          this.items = response.data.data;
        }else{

        }
    },

    editItem (item) {
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      this.deleteIndex = this.items.indexOf(item)
      this.deleteId = item.id;
      this.deleteDialog = true;
    },

    close () {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },

    async destroy () {
      await CategoriesService.delete(this.deleteId).then(response => {
        if ( response.data.code == 0 ){
          this.deleteDialog = false;
          this.items.splice(this.deleteIndex, 1);
        }
      });
    },

    async save () {
       await this.$validator.validateAll().then(result => {
        if( result ){
          if (this.editedIndex > -1) {
            var response =  CategoriesService.update(this.editedItem).then(item => {
              if ( item.data.code == 0 ){
                Object.assign(this.items[this.editedIndex], this.editedItem)
              }else{

              }
            });
          } else {
            var response =  CategoriesService.add(this.editedItem).then(item => {
              if ( item.data.code == 0 ){
                this.items.push(item.data.data)
              }else{

              }
            });
          }
          this.close()
        }
      })
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
