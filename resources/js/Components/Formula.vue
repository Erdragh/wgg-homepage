<template>
<div class="container">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.0/dist/katex.min.css" integrity="sha384-Xi8rHCmBmhbuyyhbI88391ZKP2dmfnOl4rT9ZfRI7mLTdk1wblIUnrIq35nqwEvC" crossorigin="anonymous">
	<span class="formula" ref="formula">
		<slot/>
	</span>
	<div v-if="subtext" class="subtext">
		{{ subtext }}
	</div>
</div>
</template>

<script>
import katex from 'katex';

export default {
	props: ['subtext'],
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
	text-align: center;
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
	// span.formula {
	// 	margin: 0 auto;
	// }
	div.subtext {
		display: block;
		text-align: center;
		font-style: italic;
		opacity: .8;
		font-size: .8em;
		margin-top: 10px;
		padding-top: 5px;
		position: relative;
		&:before {
			content: '';
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 1px;
			background: var(--clr-font);
			opacity: .3;
		}
	}
}
</style>