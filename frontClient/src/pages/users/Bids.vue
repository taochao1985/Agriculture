<template>
  <div id="">
    <div class="header">
      <h2 class="pull-left">竞拍列表</h2>
      <btn type="success" href="/user/bids/add" class="pull-right">新增</btn>
      <div class="clearfix"></div>
    </div>
    <div>
      
    </div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>商品名</th>
          <th>竞拍开始时间</th>
          <th>竞拍结束时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="bid in bids">
          <th scope="row">{{ bid.id }}</th>
          <td>{{ bid.name }}</td>
          <td>{{ bid.start_date + bid.start_time }}</td>
          <td>{{ bid.end_date + bid.end_time }}</td>
          <td>
            <button class="btn btn-success btn-xs" @click="editItem(bid.id)"><i class="fa fa-pencil"></i>&nbsp;修改</button>
            <button class="btn btn-danger btn-xs" @click="deleteItem(bid)"><i class="fa fa-trash-o"></i>&nbsp;删除</button>
          </td>
        </tr>
      </tbody>
    </table>
    <modal v-model="open" title="删除提醒" size="sm" @hide="callback" ok-text="确定" cancel-text="取消">
      <p>您确定要删除该竞拍吗？</p>
    </modal>
  </div>
</template>
<script>
import BidsServices from '../../services/BidsServices'
export default {
  name: '',
  data: () => ({
    bids: [],
    open: false,
    index: ''
  }),
  mounted () {
    BidsServices.list().then(response => {
      console.log(response)
      if (response.data.code === 0) {
        this.bids = response.data.data
      }
    })
  },
  methods: {
    editItem (id) {
      this.$router.push({
        name: 'editbids',
        params: {
          id: id
        }
      })
    },
    deleteItem (bid) {
      this.index = this.bids.indexOf(bid)
      this.open = true
    },
    callback (e) {
      if (e === 'ok') {
        BidsServices.delete(this.bids[this.index].id).then(response => {
          if (response.data.code === 0) {
            this.bids.splice(this.index, 1)
          }
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  .header{
    margin: 20px 0;
    .btn{
      margin-top: 10px;
    }
  }
  .modal-content .btn-primary{
    background-color: #5cb85c !important;
    border-color: #4cae4c !important;
  }
</style>
