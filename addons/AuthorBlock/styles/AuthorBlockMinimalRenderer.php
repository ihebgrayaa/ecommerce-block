<?php

namespace EcommerceBlocks\AuthorBlock\styles;

use Geniem\ACF\Interfaces\Renderer;

/**
 * Class AuthorBlockMinimalRenderer
 *
 * Renders the "Minimal" style variation of the Author Block.
 *
 * This renderer outputs a lightweight HTML structure focused on
 * the quote and author name only, without additional layout or
 * styling elements.
 *
 * @package EcommerceBlocks\AuthorBlock\styles
 */
class AuthorBlockMinimalRenderer implements Renderer {

    /**
     * Render the Author Block (Minimal style).
     *
     * Extracts block field data from the provided properties and
     * generates a minimal HTML markup containing:
     * - The author quote
     * - The author name
     *
     * All dynamic values are safely escaped before output.
     *
     * @param array $props Block properties passed by ACF/Gutenberg.
     *                     Expected to contain a `data` key with block fields.
     *
     * @return string Rendered HTML output for the minimal Author Block style.
     */
    public function render(array $props): string {
        $data = $props['data'];

        return '<p class="author author--minimal">
            “'.esc_html($data['quote'] ?? '').'”
            <strong>'.esc_html($data['author'] ?? '').'</strong>
        </p>';
    }
}
