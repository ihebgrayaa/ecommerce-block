<?php

namespace EcommerceBlocks\AuthorBlock\styles;

use Geniem\ACF\Interfaces\Renderer;

/**
 * Class AuthorBlockDefaultRenderer
 *
 * Renders the default style of the Author Block.
 *
 * This renderer displays a complete author section including:
 * - Background and text colors
 * - Optional author image
 * - Quote
 * - Author name
 * - Author role
 *
 * Styling is partially handled via inline styles derived
 * from block color settings.
 *
 * @package EcommerceBlocks\AuthorBlock\styles
 */
class AuthorBlockDefaultRenderer implements Renderer {

    /**
     * Render the Author Block (Default style).
     *
     * Builds the HTML output using block field data and applies
     * inline styles for background and text colors.
     *
     * All dynamic values are properly escaped to ensure
     * secure and safe output.
     *
     * @param array $props Block properties provided by ACF/Gutenberg.
     *                     Expected to contain a `data` array with:
     *                     - quote
     *                     - author
     *                     - role
     *                     - image
     *                     - background_color
     *                     - text_color
     *
     * @return string Rendered HTML output for the default Author Block style.
     *
     * @inheritDoc
     */
    public function render(array $props): string {

        $data = $props['data'];

        $bg = $data['background_color'] ?? '#ffffff';
        $color = $data['text_color'] ?? '#000000';
        $image = $data['image']['url'] ?? '';

        return '
        <section class="author author--default" style="background-color:'.esc_attr($bg).';color:'.esc_attr($color).'">
            '.($image ? '<img class="author__image" src="'.esc_url($image).'" alt="'.esc_attr($data['author'] ?? '').'">' : '').'
            <blockquote class="author__quote">'.esc_html($data['quote'] ?? '').'</blockquote>
            <p class="author__name">'.esc_html($data['author'] ?? '').'</p>
            <p class="author__role">'.esc_html($data['role'] ?? '').'</p>
        </section>';
    }
}
