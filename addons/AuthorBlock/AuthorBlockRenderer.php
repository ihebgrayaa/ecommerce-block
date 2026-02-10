<?php
namespace EcommerceBlocks\AuthorBlock;

use EcommerceBlocks\AuthorBlock\styles\AuthorBlockBoxedRenderer;
use EcommerceBlocks\AuthorBlock\styles\AuthorBlockDefaultRenderer;
use EcommerceBlocks\AuthorBlock\styles\AuthorBlockMinimalRenderer;
use Geniem\ACF\Interfaces\Renderer;

/**
 * Class AuthorBlockRenderer
 *
 * Handles the rendering logic for the Author Block by delegating
 * the output to a specific style renderer based on the selected
 * block style (default, boxed, or minimal).
 *
 * This class acts as a dispatcher that determines which renderer
 * should be used by inspecting the block CSS classes.
 *
 * @package EcommerceBlocks\AuthorBlock
 */
class AuthorBlockRenderer implements Renderer {

    /**
     * Render the Author Block.
     *
     * Determines the active block style by checking the block's
     * CSS class names and forwards the rendering process to
     * the corresponding style renderer.
     *
     * Supported styles:
     * - Default
     * - Boxed
     * - Minimal
     *
     * @param array $props Block properties provided by ACF/Gutenberg.
     *                     Includes block configuration, fields, and metadata.
     *
     * @return string Rendered HTML output of the block.
     */
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
