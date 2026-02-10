<?php

namespace EcommerceBlocks\HeroBlock\styles;

use Geniem\ACF\Interfaces\Renderer;

class HeroBlockHomeOneRenderer implements Renderer {

	public function render(array $props): string {

		$slides = $props['data']['slider'] ?? [];

		if (empty($slides)) {
			return '';
		}

		ob_start();
		?>
		<div class="tf-slideshow slider-effect-fade position-relative">
			<div dir="ltr"
			     class="swiper tf-sw-slideshow"
			     data-preview="1"
			     data-tablet="1"
			     data-mobile="1"
			     data-centered="false"
			     data-space="0"
			     data-loop="true"
			     data-auto-play="false"
			     data-delay="0"
			     data-speed="1000">

				<div class="swiper-wrapper">

					<?php foreach ($slides as $slide):
						$image = $slide['picture']['url'] ?? '';
						$title = $slide['title'] ?? '';
						$desc  = $slide['description'] ?? '';
						$btn   = $slide['button'] ?? [];
						?>
						<div class="swiper-slide">
							<div class="wrap-slider">

								<?php if ($image): ?>
									<img src="<?php echo esc_url($image); ?>" alt="fashion-slideshow">
								<?php endif; ?>

								<div class="box-content">
									<div class="container">

										<?php if ($title): ?>
											<h1 class="fade-item fade-item-1">
												<?php echo nl2br(esc_html($title)); ?>
											</h1>
										<?php endif; ?>

										<?php if ($desc): ?>
											<p class="fade-item fade-item-2">
												<?php echo esc_html($desc); ?>
											</p>
										<?php endif; ?>

										<?php if (!empty($btn['button-text']) && !empty($btn['button-link'])): ?>
											<a href="<?php echo esc_url($btn['button-link']); ?>"
											   class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3">
												<span><?php echo esc_html($btn['button-text']); ?></span>
												<i class="icon icon-arrow-right"></i>
											</a>
										<?php endif; ?>

									</div>
								</div>

							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>

			<div class="wrap-pagination">
				<div class="container">
					<div class="sw-dots sw-pagination-slider justify-content-center"></div>
				</div>
			</div>
		</div>
		<?php

		return ob_get_clean();
	}
}
