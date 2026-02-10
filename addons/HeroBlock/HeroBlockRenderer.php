<?php

namespace EcommerceBlocks\HeroBlock;

use EcommerceBlocks\HeroBlock\styles\HeroBlockHomeOneRenderer;
use Geniem\ACF\Interfaces\Renderer;

/**
 * Class HeroBlockRenderer
 *
 * Acts as the main renderer dispatcher for the Hero Block.
 *
 * This class determines which Hero Block style renderer should be
 * used based on the block's CSS class names and delegates the
 * rendering process accordingly.
 *
 * @package EcommerceBlocks\HeroBlock
 */
class HeroBlockRenderer implements Renderer {

    /**
     * Render the Hero Block.
     *
     * Inspects the block's class names to identify the selected
     * block style and forwards rendering to the appropriate
     * style-specific renderer.
     *
     * Currently supported styles:
     * - Home 1
     *
     * @param array $data Block properties provided by ACF/Gutenberg.
     *                    Includes block configuration, fields, and metadata.
     *
     * @return string Rendered HTML output of the Hero Block.
     *
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
