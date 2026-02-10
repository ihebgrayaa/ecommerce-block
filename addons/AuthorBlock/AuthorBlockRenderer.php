<?php
namespace EcommerceBlocks\AuthorBlock;

use EcommerceBlocks\AuthorBlock\styles\AuthorBlockBoxedRenderer;
use EcommerceBlocks\AuthorBlock\styles\AuthorBlockDefaultRenderer;
use EcommerceBlocks\AuthorBlock\styles\AuthorBlockMinimalRenderer;
use Geniem\ACF\Interfaces\Renderer;

class AuthorBlockRenderer implements Renderer {

	public function render(array $props): string {
		$classes = $props['block']['className'] ?? '';
		return match (true) {
			str_contains($classes, 'is-style-boxed') =>
			(new AuthorBlockBoxedRenderer())->render($props),

			str_contains($classes, 'is-style-minimal') =>
			(new AuthorBlockMinimalRenderer())->render($props),

			default =>
			(new AuthorBlockDefaultRenderer())->render($props),
		};
	}
}
