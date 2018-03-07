<template>
  <div id="">
    <div class="header">
      <h2>{{pageName}}</h2>
    </div>

    <div class="col-md-12">
      <form class="form-horizontal">  
        <div class="form-group">
          <label for="inputEmail3" class="col-md-2 control-label">分类</label>
          <div class="col-md-6">
            <select class="form-control" 
              v-model="bid.cate_id"
              v-on:change="$v.bid.cate_id.$touch"
              v-bind:class="{error: $v.bid.cate_id.$error, valid: $v.bid.cate_id.$dirty && !$v.bid.cate_id.$invalid}"
               >
                <option value="0">请选择</option>
              <template v-for="cate in categories">
                <option :value="cate.id"> {{ cate.name }}</option>
              </template>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-md-2 control-label">商品名</label>
          <div class="col-md-10 " >
            <input type="text" 
            class="form-control" 
            v-model="bid.name" 
            v-on:input="$v.bid.name.$touch"
            v-on:blur="$v.bid.name.$touch"
            v-bind:class="{error: $v.bid.name.$error, valid: $v.bid.name.$dirty && !$v.bid.name.$invalid}"
            >
            <span class="form-group__message" v-if="!$v.bid.name.required">Field is required</span>
            <span class="form-group__message" v-if="!$v.bid.name.minLength">Name must have at least {{$v.bid.name.$params.minLength.min}} letters.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="start_date" class="col-md-2 control-label">竞拍开始时间</label>
          <div class="col-md-3">
            <dropdown >
              <div class="input-group">
                <input class="form-control" type="text" v-model="bid.start_date">
                <div class="input-group-btn">
                  <btn class="dropdown-toggle"><i class="glyphicon glyphicon-calendar"></i></btn>
                </div>
              </div>
              <template slot="dropdown">
                <li>
                  <date-picker v-model="bid.start_date" />
                </li>
              </template>
            </dropdown>
          </div>
          <div class="col-md-3">
            <label for="end_time" class="col-md-5 control-label">时间：</label>
            <time-picker v-model="bid.start_time" :show-meridian="false" :controls="false" />
          </div>
        </div>
        <div class="form-group">
          <label for="end_date" class="col-md-2 control-label">竞拍结束日期</label>
          <div class="col-md-3">
            <dropdown >
              <div class="input-group">
                <input class="form-control" type="text" v-model="bid.end_date">
                <div class="input-group-btn">
                  <btn class="dropdown-toggle"><i class="glyphicon glyphicon-calendar"></i></btn>
                </div>
              </div>
              <template slot="dropdown">
                <li>
                  <date-picker v-model="bid.end_date"/>
                </li>
              </template>
            </dropdown>
          </div>
          <div class="col-md-3">
            <label for="end_time" class="col-md-5 control-label">时间：</label>
            <time-picker v-model="bid.end_time" :show-meridian="false" :controls="false" />
          </div>
        </div>
        <div class="form-group">
          <label for="attachments" class="col-md-2 control-label">商品图片</label>
          <div class="col-md-10">
            <file-upload v-on:fileUploaded="fileUploaded"></file-upload>
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-md-2 control-label">商品简介</label>
          <div class="col-md-10">
            <editor v-on:description="description"></editor>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
            <button type="button" class="btn btn-success" @click="handleBidFormSubmit($v)">保存</button>
            <button type="button" class="btn btn-default">取消</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import CategoryServices from '../../services/CategoryServices'
import BidsServices from '../../services/BidsServices'
import Editor from './common/Editor'
import FileUpload from './common/Upload'
import { required, minLength, between } from 'vuelidate/lib/validators'
export default {
  components: {
    Editor,
    FileUpload
  },
  data: () => ({
    pageName: '新增竞拍',
    categories: [],
    bid: {
      name: '',
      cate_id: 0,
      description: '',
      attachments: [],
      start_date: null,
      end_date: null,
      start_time: new Date(''),
      end_time: new Date('')
    }
  }),
  validations: {
    bid: {
      name: {
        required,
        minLength: minLength(4)
      },
      cate_id: {
        required,
        between: between(1, 3333)
      }
    },
    validationGroup: ['bid.name', 'bid.cate_id']
  },
  methods: {
    fileUploaded (data) {
      var attachments = this.bid.attachments
      if (data.type === 'add') {
        attachments.push(data.src)
      } else {
        var index = attachments.indexOf(data.src)
        if (index > -1) {
          attachments.splice(index, 1)
        }
      }
    },
    handleBidFormSubmit ($v) {
      $v.$touch()
      if (!$v.$invalid) {
        if (this.bid.id > 0) {
          BidsServices.update(this.bid)
        } else {
          BidsServices.add(this.bid)
        }
      }
    },
    description (data) {
      this.bid.description = data
    }
  },
  created () {
    CategoryServices.list().then(response => {
      if (response.data.code === 0) {
        this.categories = response.data.data
      }
    })
  },
  async mounted () {
    console.log(new Date('2018-03-07T03:23:05.139Z'))
    var id = this.$router.history.current.params.id
    BidsServices.show(id).then(bid => {
      if (bid.data.code === 0) {
        bid.data.data.start_time = new Date(bid.data.data.start_time)
        bid.data.data.end_time = new Date(bid.data.data.end_time)
        this.bid = bid.data.data
      }
    })
  }
}
</script>
<style lang="scss" scoped>
  .header{
    margin: 30px 0;
    border-bottom: 1px solid #388E3C;
    .btn{
      margin-top: 10px;
    }
  }
  .alert-danger{
    padding:5px 15px;
    margin-top: 10px;
  }
  input {
    border: 1px solid silver;
    border-radius: 4px;
    background: white;
    padding: 5px 10px;
  }

.error {
  border-color: red;
  background: #FDD;
}

.error:focus {
  outline-color: #F99;
}

.valid {
}

.valid:focus {
  outline-color: #8E8;
}
</style>
