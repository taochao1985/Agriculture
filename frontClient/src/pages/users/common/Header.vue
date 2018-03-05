<template>
	<navbar inverse>
  <a class="navbar-brand" slot="brand" href="#">Brand</a>
  <template slot="collapse">
    <navbar-nav>
      <li class="active"><a role="button">Link <span class="sr-only">(current)</span></a></li>
      <li><a role="button">Link</a></li>
    </navbar-nav>
    <navbar-form left>
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
  </template>
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
	.navbar-inverse{
		background-color: #5cb85c;
		border-color:#4cae4c;
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
