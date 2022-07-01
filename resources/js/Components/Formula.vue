<template>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.0/dist/katex.min.css" integrity="sha384-Xi8rHCmBmhbuyyhbI88391ZKP2dmfnOl4rT9ZfRI7mLTdk1wblIUnrIq35nqwEvC" crossorigin="anonymous">
<div class="formula" ref="formula"><slot/></div>
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

</style>