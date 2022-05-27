<template>
    <Head title="Home"/>

    <slideshow :slides="slides"></slideshow>
    <vue-headline class="mt-6">Hallo!</vue-headline>
	<div class="outer">
		<div class="preview">
			<div class="force-thumbnail-aspect-ratio">
				<img :src="'/img/color1-article.jpeg'" class="thumbnail">
			</div>
			<div class="text">
				<div class="centered">
					<h2>Wir sind das WGG</h2>
					<div class="desc">Wir sind ein bayerisches Gynmasium, das sehr stolz auf seine Technologie ist.</div>
					<a href="/tag/Gemeinschaft">
						<span>Mehr Lesen</span><div class="arrow">0</div>
					</a>
				</div>
			</div>
		</div>
		<div class="preview">
			<div class="text">
				<div class="centered">
					<h2>Anmeldung bei uns</h2>
					<div class="desc">Der Anmeldungsvorgang kann komplett online abgeschlossen werden.</div>
					<a href="Schulanmeldung">
						<span>Mehr Lesen</span><div class="arrow">0</div>
					</a>
				</div>
			</div>
			<div class="force-thumbnail-aspect-ratio">
				<img :src="'/img/color3-article.jpeg'" class="thumbnail">
			</div>
		</div>
		<div class="preview">
			<div class="text">
				<div class="centered">
					<h2>Anmeldung bei uns</h2>
					<div class="desc">Der Anmeldungsvorgang kann komplett online abgeschlossen werden.</div>
					<a href="Schulanmeldung">
						<span>Mehr Lesen</span><div class="arrow">0</div>
					</a>
				</div>
			</div>
			<div class="force-thumbnail-aspect-ratio">
				<img :src="'/img/color3-article.jpeg'" class="thumbnail">
			</div>
			<div class="text">
				<div class="centered">
					<h2>Anmeldung bei uns</h2>
					<div class="desc">Der Anmeldungsvorgang kann komplett online abgeschlossen werden.</div>
					<a href="Schulanmeldung">
						<span>Mehr Lesen</span><div class="arrow">0</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
    
</style>

<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Slideshow from '@components/Slideshow';
import VueHeadline from '@components/VueHeadline';

const props = defineProps({
    slides: Array,
})
</script>

<script>
import MainAppLayout from '@/Layouts/MainAppLayout.vue'; 

export default {
    layout: MainAppLayout
}
</script>

<style lang="scss" scoped>
div.outer {
	max-width: var(--sz-content-width);
	margin: 0 auto;
	margin-top: 15px;
	div.preview {
		display: flex;
		&:last-child .force-thumbnail-aspect-ratio {
			border-bottom: 10px solid var(--clr-bg-primary);
		}
		.force-thumbnail-aspect-ratio { 
			// CLARIFICATION:
			// This workaround replicates the behavior of the experimental feature 'aspect-ratio'
			// SOURCE:
			// https://pqina.nl/blog/presenting-images-in-an-aspect-ratio-with-css/
			//
			position: relative;
			width: calc(100% + 50px);
			background: var(--clr-bg-primary);
			overflow: hidden;
			border: 10px solid var(--clr-bg-primary);
			border-bottom: none;
			// transform: translate(-25px, 0);

			&::after {
				display: block;
				content: '';
				padding-bottom: 60%; // aspect ratio
			}
			&:before {
				z-index: 3;
				content: '';
				position: absolute;
				pointer-events: none;
				box-shadow: inset 0 0 25px #00000022;
				width: 100%;
				height: 100%;
			}

			.thumbnail {
				z-index: 2;
				position: absolute;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				object-fit: cover;
				transition-duration: .2s;
				// background-color: hsl(0, 0%, 80%);
			}

			@at-root html.no-touchevents &:hover .thumbnail {
				transform: scale(1.03);
			}
		}
		div.text {
			background: var(--clr-bg-primary);
			color: var(--clr-font);
			padding: 15px;
			position: relative;
			div.centered {
				top: 50%;
				position: relative;
				transform: translateY(-50%);
				text-align: center;
				h2 {
					font-weight: bold;
					font-size: 30px;
				}
				div.desc {
					font-size: 20px;
				}
				a {
					font-size: 22px;
					position: relative;
					display: flex;
					margin-top: 15px;
					margin-inline: auto;
					width: max-content;
					span {
						position: relative;
					}
					& span:before {
						content: '';
						background: var(--clr-font);
						width: 0;
						height: 2px;
						position: absolute;
						bottom: 0;
						left: 50%;
						transition-duration: .2s;
						transform: translate(-50%, 0px);
					}
					@at-root html.no-touchevents &:hover span:before {
						width: 100%;
					}
					div.arrow {
						font-size: 20px;
						position: relative;
						// transform: rotateZ(45deg);
						color: transparent;
						height: 100%;
						&:before {
							position: absolute;
							content: '';
							top: 50%;
							transform: translateY(-50%) rotateZ(45deg);
							display: block;
							height: 1ch;
							width: 1ch;
							border-top: 2px solid var(--clr-font);
							border-right: 2px solid var(--clr-font);
						}
					}
				}
			}
		}
	}
}
</style>