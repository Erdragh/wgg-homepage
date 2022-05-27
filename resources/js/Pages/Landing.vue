<template>
    <Head title="Home"/>

    <slideshow :slides="slides"></slideshow>
	<div class="outer">
		<div class="left">
			<div class="image-container">
				<div class="aspect-ratio">
					<img :src="'/img/color1-article.jpeg'" class="thumbnail">
				</div>
				<div class="imagetext bottom">
					<div class="center-container">
						<div class="centered">
							<h3>Gut zu wissen:</h3>
							<p>Unsere Schule ist sehr jung, sie wurde erst 2013 fertig gestellt!</p>
							<a class="link" href="/Schulgebäude">Mehr über das Schulgebäude</a>
						</div>
					</div>
				</div>
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
		<div class="right">
			<div class="text">
				<div class="centered">
					<h2>Anmeldung bei uns</h2>
					<div class="desc">Der Anmeldungsvorgang kann komplett online abgeschlossen werden.</div>
					<a href="Schulanmeldung">
						<span>Mehr Lesen</span><div class="arrow">0</div>
					</a>
				</div>
			</div>
			<div class="image-container">
				<div class="aspect-ratio">
					<img :src="'/img/color3-article.jpeg'" class="thumbnail">
				</div>
				<div class="imagetext top">
					<div class="center-container">
						<div class="centered">
							<h3>Gut zu wissen:</h3>
							<p>An unserer Schule gab es im Schuljahr 2018/2019 <i>1272</i> Schüler und <i>129</i> Lehrer</p>
							<a href="https://de.wikipedia.org/wiki/Willibald-Gluck-Gymnasium" class="link">Mehr dazu auf Wikipedia</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="left">
			<div class="image-container">
				<div class="aspect-ratio">
					<img :src="'/img/color10-article.jpeg'" class="thumbnail">
				</div>
				<div class="imagetext right">
					<div class="center-container">
						<div class="centered">
							<h3>Gut zu wissen:</h3>
							<p>Manchmal haben wir Gäste, die uns ein Konzert geben, manchmal kann man Lebkuchen kaufen.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="text">
				<div class="centered">
					<h2>Aktuelle Events und Termine</h2>
					<div class="desc">Von Wettbewerben über Genossenschaften bis hin zum Tag der offenen Tür</div>
					<a href="/tag/Events">
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
	padding-top: 30px;
	background: var(--clr-bg-primary);
	div.right, div.left {
		display: flex;
		&:last-child .image-container .aspect-ratio:before {
			border-bottom: 10px solid var(--clr-bg-primary);
		}
		.image-container {
			position: relative;
			width: 75%;
			.aspect-ratio { 
				// CLARIFICATION:
				// This workaround replicates the behavior of the experimental feature 'aspect-ratio'
				// SOURCE:
				// https://pqina.nl/blog/presenting-images-in-an-aspect-ratio-with-css/
				//
				position: relative;
				width: calc(100% + 0px);
				background: var(--clr-bg-primary);
				overflow: hidden;
				// transform: translate(-25px, 0);
				&::after {
					display: block;
					content: '';
					padding-bottom: 60%; // aspect ratio
				}

				&:before {
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					z-index: 3;
					width: 100%;
					height: 100%;
					box-shadow: inset 0 0 25px #00000022;
					border: 10px solid var(--clr-bg-primary);
					border-bottom: none;
					pointer-events: none;
				}

				.thumbnail {
					position: absolute;
					left: 0;
					top: 0;
					width: 100%;
					height: 100%;
					//z-index: 1;
					object-fit: cover;
					transition-duration: .2s;
					// background-color: hsl(0, 0%, 80%);
				}
			}

			div.imagetext {
				position: absolute;
				background: var(--clr-bg-primary);
				color: var(--clr-font);
				@at-root html.backdropfilter & {
					background: var(--clr-bg-transparent);
					backdrop-filter: blur(20px);
				}
				box-shadow: 0 0 25px #00000022;
				padding: 15px;
				transition-duration: .2s;
				text-align: center;
				//z-index: 2;
				.center-container {
					position: relative;
					height: 100%;
					.centered {
						position: relative;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
						h3 {
							font-weight: bold;
						}
					}
				}
				&.bottom {
					bottom: 0;
					left: 50%;
					height: 50%;
					transform: translate(-50%, 0);
					border-top-left-radius: 10px;
					border-top-right-radius: 10px;
				}
				&.top {
					top: 0;
					left: 50%;
					height: 50%;
					transform: translate(-50%, 0);
					border-bottom-left-radius: 10px;
					border-bottom-right-radius: 10px;
				}
				&.right {
					top: 50%;
					right: 0;
					height: 50%;
					width: 50%;
					transform: translate(0, -50%);
					border-bottom-left-radius: 10px;
					border-top-left-radius: 10px;
				}
			}
			@at-root html.no-touchevents & {
				div.imagetext {
					opacity: 0;
				}
				div.imagetext.bottom {
					transform: translate(-50%, 100%);
				}
				div.imagetext.top {
					transform: translate(-50%, -100%);
				}
				div.imagetext.right {
					transform: translate(100%, -50%);
				}
				&:hover {
					.thumbnail {
						transform: scale(1.03);
					}
					div.imagetext {
						opacity: 1;
					}
					div.imagetext.bottom {
						transform: translate(-50%, 0);
					}
					div.imagetext.top {
						transform: translate(-50%, 0);
					}
					div.imagetext.right {
						transform: translate(0, -50%);
					}
				}
			}
		}
		div.text {
			background: var(--clr-bg-primary);
			color: var(--clr-font);
			padding: 15px;
			position: relative;
			z-index: 5;
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

@media only screen and (max-width: 800px) {
	div.outer {
		div.right, div.left {
			div.image-container {
				width: 100%;
			}
			div.text {
				div.centered {
					transform: none;
				}
			}
		}
		div.right {
			flex-direction: column-reverse;
		}
		div.left {
			flex-direction: column;
		}
	}
}

@media only screen and (max-width: 650px) {
	div.outer {
		div.right, div.left {
			div.image-container {
				div.imagetext {
					width: 60% !important;
					height: 60% !important;
				}
			}
		}
	}
}

@media only screen and (max-width: 480px) {
	div.outer div.right, div.outer div.left {
		div.image-container {
			display: flex;
			flex-direction: column;
			div.imagetext {
				position: relative;
				top: 0 !important;
				left: 0 !important;
				transform: none !important;
				border-radius: 5px !important;
				box-shadow: none;
				height: auto;
				width: auto !important;
				border: 1px solid var(--clr-bg-secondary);
				margin: 15px;
				div.centered {
					position: relative !important;
					top: auto !important;
					left: auto !important;
					transform: none !important;
				}
			}
		}
	}
}

@media only screen and (max-width: 1015px) and (min-width: 910px) {
	div.outer {
		div.right, div.left {
			div.image-container {
				div.imagetext {
					width: 60% !important;
					height: 60% !important;
				}
			}
		}
	}
}
@media only screen and (max-width: 910px) and (min-width: 800px) {
	div.outer {
		div.right, div.left {
			div.image-container {
				div.imagetext {
					width: 75% !important;
					height: 75% !important;
				}
			}
		}
	}
}
</style>