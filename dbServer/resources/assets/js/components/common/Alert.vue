<template>
	<v-snackbar
		:timeout="timeout"
		color='error'
		top
		right
		v-model="snackbar"
	>{{alertMessage}}
		<v-btn flat  dark @click.native="snackbar = false">Close</v-btn>
	</v-snackbar>
</template>
<script>
export default {
  name: "",
  data: () => ({
		timeout:1000,
		snackbar: false
  }),
	props: ['alertMessage'],
	watch: {
		alertMessage(value) {
			this.snackbar = true;
		}
	}
}
</script>
<style lang="scss" scoped>
</style>
