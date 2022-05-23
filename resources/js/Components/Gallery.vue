<template>
	<div class="gallery-container">
		<div class="gallery-title">
			{{ title }}
		</div>
		<div ref="container" class="gallery">
			<slot/>
		</div>
		<div ref="overlay" class="gallery-overlay">
			<div ref="close" class="close" @click="toggleOverlay()"></div>
			<div class="overlay-content">
				<div ref="closebutton" class="closebutton" @click="toggleOverlay()">
					<i class="material-icons">close</i>
				</div>
				<div class="overlay-title">
					{{ title }}
				</div>
				<hr>
				<div ref="next" class="slidebutton next" @click="overlaySlideBy(1)">
					<i class="material-icons">arrow_right</i>
				</div>
				<div ref="prev" class="slidebutton prev" @click="overlaySlideBy(-1)">
					<i class="material-icons">arrow_left</i>
				</div>
				<div ref="slide" class="overlay-figures">
					<slot/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Isotope from 'isotope-layout'
import imagesLoaded from 'imagesloaded'

export default {
	props: ['title'],

	mounted() {
		//Resources:
		//https://isotope.metafizzy.co
		//https://masonry.desandro.com

		var gallery = this.$refs.container;
		// console.log(gallery.children[0]);
		// for (var i = 0; i < gallery.children.length; i++) {
		// 	gallery.children[i].classList.add("brick")
		// }
		var isotope = new Isotope(gallery, {
			//options
			itemSelector: 'figure',
			layoutMode: 'masonry',
			transitionDuration: 0,
			masonry: {
				gutter: 12
			}
		});

		// rearrange isotope everytime an image is finished loading
		var imgLoad = imagesLoaded(gallery);
		imgLoad.on('progress', function(instance, image) {
			isotope.arrange();
		});

		//rearrange isotope when gallery is resized
		var lastIsotopeWidth = gallery.clientWidth
		window.addEventListener('resize', function() {
			if (lastIsotopeWidth != gallery.clientWidth) {
				isotope.arrange();
			}
			lastIsotopeWidth = gallery.clientWidth;
		});
		//TODO: Doesn't work apparently. Currently only tested in desktop browser.
		//rearrange isotope when the device has its orientation changed
		//should prevent buggy behaviour when the device is rotated
		// window.addEventListener("orientationchange", function() {
		// 	isotope.arrange();
		// 	console.log(screen.orientation);
		// }, false);

		//Give the different figures onclick events to open the overlay
		for (var i = 0; i < gallery.children.length; i++) {
			//I had hoped to use the methods defined below, but those aren't available when setting an onclick method that needs a parameter, sadly ~ Jan/Erdragh
			gallery.children[i].onclick = function(e) {
				var overlay = e.target.parentElement.parentElement.parentElement.querySelector(".gallery-overlay");
				var index = [].slice.call(e.target.parentElement.parentElement.children).indexOf(e.target.parentElement);
				var figures = [].slice.call(overlay.querySelector(".overlay-figures").children);
				figures.forEach(figure => {
					figure.classList.remove("active");
				});
				figures[index].classList.add("active");
				overlay.classList.toggle("open");
			}
		}

		//Give the slide buttons their functionality
		// closebutton.onclick = "console.log('test')";
	},
	methods: {
		toggleOverlay: function() {
			this.$refs.overlay.classList.toggle("open");
		},
		activateChild: function(children, index) {
			for (var i = 0; i < children.length; i++) {
				children[i].classList.remove("active");
			}
			children[index].classList.add("active");
		},
		overlaySlideBy: function(amount) {
			var figures = this.$refs.slide.children;
			for (var i = 0; i < figures.length; i++) {
				if (figures[i].classList.contains("active")) {
					// console.log("evaluating Index for " + amount);
					var newActiveIndex = this.evaluateIndex(figures.length, i, amount);
					// console.log("index evaluates to: " + newActiveIndex);
					this.activateChild(figures, newActiveIndex);
					return;
				}
			}
			// This will only be executed in case no other active children have been found.
			var newActiveIndex = this.evaluateIndex(figures.length, 0, amount);
			// console.log(newActiveIndex);
			this.activateChild(figures, newActiveIndex);
		},
		//Yes, this is very overengineered, it would have been easier to just restrict the slide to only increment by one. But hey, I wanted to kill some time ~ Jan/Erdragh
		evaluateIndex: function(length, start, amount) {
			if (amount > 0) {
				if (amount >= length) {
					return this.evaluateIndex(length, start, (amount - length));
				} else if ((start + amount) >= length) {
					return ((start - length) + amount);
				} else {
					return (start + amount);
				}
			} else if (amount < 0) {
				if ((-amount) >= length) {
					return this.evaluateIndex(length, start, (amount + length));
				} else if ((start + amount) < 0) {
					return ((length) + (start + amount));
				} else {
					return (start + amount);
				}
			} else {
				return 0;
			}
		}
	}
}
</script>

<style lang="scss">
$spacing: 15px;

.gallery-container {
	.gallery-title {
		font-size: 20px;
		font-weight: bold;
		margin-bottom: .5em;
	}
	.gallery {
		position: relative;
		margin: 0 auto;
		margin-bottom: 1em;
		font-size: 18px;
		figure {
			width: calc(33.3333% - 8px);
			margin-bottom: 8px !important;
			transition-duration: .1s;
			cursor: pointer;
			@at-root html.no-touchevents &:hover {
				transform: scale(1.01);
			}
			img {
				border-radius: $spacing;
			}
			figcaption {
				font-style: normal !important;
				a {
					pointer-events: none !important;
				}
			}
			@media only screen and (max-width: 700px) {
				
			}
		}
	}
	.gallery-overlay {
		z-index: 1000;
		opacity: 0;
		pointer-events: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		transition-duration: .1s;
		.close {
			position: absolute;
			top: 0; left: 0;
			width: 100%;
			height: 100%;
			cursor: pointer;
			background-color: rgba(0,0,0,.3);
		}
		.overlay-content {
			display: flex;
			flex-direction: column;
			position: absolute;
			top: 50%; left: 0;
			transform: translateY(-50%);
			height: 80%;
			width: 100%;
			background-color: var(--clr-bg-primary);
			color: var(--clr-font);
            box-shadow: 0 0 15px rgba(0,0,0,.05);
			.closebutton {
				position: absolute;
				top: $spacing;
				right: $spacing;
				height: 30px;
				width: 30px;
				background: var(--clr-bg-primary);
				border-radius: 15px;
            	box-shadow: 0 0 15px rgba(0,0,0,.05);
				border: 1px solid var(--clr-bg-secondary);
				text-align: center;
				cursor: pointer;
				transition-duration: .1s;
				i {
					font-size: 28px;
				}
				@at-root html.no-touchevents &:hover {
					color: var(--clr-wgg-orange);
					&:active {
						background: var(--clr-bg-secondary);
					}
				}
			}
			.overlay-title {
				width: 100%;
				line-height: 30px;
				padding: $spacing;
				font-size: 25px;
				font-family: var(--fnt-title);
				font-weight: bolder;
			}
			hr {
				margin-bottom: 10px;
			}
			.slidebutton {
				position: absolute;
				z-index: 1001;
				top: 50%;
				transform: translateY(-50%);
				width: 50px;
				height: 50px;
				text-align: center;
				border-radius: 25px;
				cursor: pointer;
				transition-duration: .1s;
				background: rgba(0,0,0,.3);
            	box-shadow: 0 0 15px rgba(0,0,0,.15);
				color: white;
				&:hover {
					background: rgba(20,20,20,.3);
				}
				&:active {
					background: rgba(0,0,0,.5);
				}
				@at-root html.backdropfilter & {
					backdrop-filter: blur(5px);
				}
				i {
					line-height: 50px;
					font-size: 45px;
				}
			}
			.slidebutton.next {
				right: $spacing;
			}
			.slidebutton.prev {
				left: $spacing;
			}
			.overlay-figures {
				position: relative;
				flex: 1 1 auto;
				overflow: hidden;
				figure {
					position: relative;
					display: none;
					margin: 0 !important;
					max-width: none !important;
					transition-duration: .2s;
					transition-timing-function: linear;
					height: 100%;
					&.active {
						display: block;
					}
					img {
						position: absolute;
						top: 50%;
						transform: translateY(-50%);
						border-radius: 0 !important;
						max-height: 100% !important;
						width: auto;
						margin: 0 auto;
						vertical-align: center;
						object-fit: contain;
					}
					figcaption {
						position: absolute;
						left: 0;
						bottom: 0;
						width: 100%;
						background: rgba(0,0,0,.6);
            			box-shadow: 0 0 15px rgba(0,0,0,.3) !important;
						opacity: 1 !important;
						@at-root html.backdropfilter & {
							backdrop-filter: blur(15px);
						}
						padding: $spacing;
						color: white;
						margin: 0 !important;
						font-style: normal !important;
					}
				}
			}
		}
		&.open {
			opacity: 1;
			pointer-events: all;
		}
	}
}

@media only screen and (max-width: 750px) {
	.gallery-container {
		.gallery {
			figure {
				width: calc(50% - 6px);
			}
		}
	}
}

@media only screen and (max-height: 700px) {
	.gallery-container {
		.gallery-overlay {
			.overlay-content {
				height: 100%;
				.overlay-title {
					font-size: 20px;
				}
				.overlay-figures {
					figure {
						img {
							top: 0;
							transform: none;
							box-shadow: 0 0 15px rgba(0,0,0,.15);
						}
					}
				}
			}
		}
	}
}

@media only screen and (max-width: 420px) {
	.gallery-container {
		.gallery {
			figure {
				width: 100%;
			}
		}
	}
}

@media only screen and (max-width: 700px) {
	.gallery-container {
		padding-inline: 10px;
		.gallery {
			figure {
				img {
					border-radius: 5px !important;
				}
			}
		}
	}
}
</style>