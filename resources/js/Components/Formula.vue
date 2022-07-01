<template>
<div class="container">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.0/dist/katex.min.css" integrity="sha384-Xi8rHCmBmhbuyyhbI88391ZKP2dmfnOl4rT9ZfRI7mLTdk1wblIUnrIq35nqwEvC" crossorigin="anonymous">
	<span ref="formula">
		<slot/>
	</span>
</div>
</template>

<script>
import katex from 'katex';

export default {
	mounted() {
		katex.render(this.$refs.formula.innerHTML, this.$refs.formula, {
			throwOnError: false
		});
	}
}
</script>

<style lang="scss" scoped>
div.container {
	padding: 10px;
	width: max-content;
	margin-inline: auto;
	&.left {
		// text-align: center;
		margin-left: 0;
		&.float {
			margin-right: 0;
			float: left;
		}
	}
	&.right {
		// text-align: right;
		margin-right: 0;
		&.float {
			margin-left: 0;
			float: right;
		}
	}
}
</style>