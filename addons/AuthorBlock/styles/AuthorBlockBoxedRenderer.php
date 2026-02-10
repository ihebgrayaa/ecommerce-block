<?php

namespace EcommerceBlocks\AuthorBlock\styles;

use Geniem\ACF\Interfaces\Renderer;

/**
 * Class AuthorBlockBoxedRenderer
 *
 * Renders the "Boxed" style variation of the Author Block.
 *
 * This renderer displays the author content inside a boxed layout,
 * grouping the image, quote, author name, and role within a
 * dedicated container for visual emphasis.
 *
 * @package EcommerceBlocks\AuthorBlock\styles
 */
class AuthorBlockBoxedRenderer implements Renderer {

    /**
     * Render the Author Block (Boxed style).
     *
     * Generates a boxed layout containing:
     * - Optional author image
     * - Quote
     * - Author name
     * - Author role
     *
     * All dynamic values are escaped to ensure safe HTML output.
     *
     * @param array $props Block properties passed by ACF/Gutenberg.
     *                     Expected to contain a `data` array with block fields.
     *
     * @return string Rendered HTML output for the boxed Author Block style.
     */
    public function render(array $props): string {

        $data = $props['data'];
        $image = $data['image']['url'] ?? '';

        return '
        <section class="author author--boxed">
            <div class="author__box">
                '.($image ? '<img src="'.esc_url($image).'" alt="'.esc_attr($data['author'] ?? '').'">' : '').'
                <blockquote>'.esc_html($data['quote'] ?? '').'</blockquote>
                <strong>'.esc_html($data['author'] ?? '').'</strong>
                <span>'.esc_html($data['role'] ?? '').'</span>
            </div>
        </section>';
    }
}
