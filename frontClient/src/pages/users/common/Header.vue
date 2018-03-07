<template>
	<navbar inverse >
    <div class="container">
      <a class="navbar-brand" slot="brand" href="#">Brand</a>
      <navbar-nav>
        <li class="active"><a role="button">Link <span class="sr-only">(current)</span></a></li>
        <li><a role="button">Link</a></li>
      </navbar-nav>
      <navbar-form left hidden>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <btn>Submit</btn>
      </navbar-form>
      <navbar-nav right>
        <li><a role="button">Link</a></li>
        <dropdown tag="li">
          <a class="dropdown-toggle" role="button">Dropdown <span class="caret"></span></a>
          <template slot="dropdown">
            <li><a role="button">Action</a></li>
            <li><a role="button">Another action</a></li>
            <li><a role="button">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a role="button">Separated link</a></li>
          </template>
        </dropdown>
      </navbar-nav> 
  </div>
</navbar>
</template>
<script>
export default {
  name: '',
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
  .navbar{
  	margin-bottom: 40px;
  }
	.navbar-inverse{
		background-color: #43A047;
		border-color:#388E3C;
		border-radius: 0;
		.navbar-brand{
			color: #fff;
		}
		.navbar-nav{
			li{
				a{
					color: #fff;
				}
			}
		}
	}
</style>
