<?php

namespace EcommerceBlocks\HeroBlock;

use EcommerceBlocks\HeroBlock\styles\HeroBlockHomeOneRenderer;
use Geniem\ACF\Interfaces\Renderer;

class HeroBlockRenderer implements Renderer {

	/**
	 * @inheritDoc
	 */
	public function render( array $data ): string {
		$classes = $data['block']['className'] ?? '';
		return match (true) {
			str_contains($classes, 'is-style-home_1') =>
			(new HeroBlockHomeOneRenderer())->render($data),
		};
	}
}