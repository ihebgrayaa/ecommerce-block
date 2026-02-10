<?php
namespace EcommerceBlocks\AuthorBlock;

use Exception;
use Geniem\ACF\Block;
use Geniem\ACF\Field\Accordion;
use Geniem\ACF\Field\Color;
use Geniem\ACF\Field\Image;
use Geniem\ACF\Field\Text;
use Geniem\ACF\Field\Textarea;

/**
 * Class AuthorBlock
 *
 * Represents a custom Gutenberg block for displaying author information,
 * including quote, author name, role, image, and color settings.
 *
 * Extends the Geniem\ACF\Block class to define fields, styles, category,
 * icon, keywords, and renderer for the block.
 *
 * @package EcommerceBlocks\AuthorBlock
 */
class AuthorBlock extends Block {

    /**
     * AuthorBlock constructor.
     *
     * Initializes the Author Block with:
     * - Text fields for quote, author name, and role
     * - Image field for author image
     * - Accordion for color settings (background and text color)
     * - Predefined block styles (default, boxed, minimal)
     * - Block category, icon, keywords
     * - Renderer for output
     *
     * @throws Exception If block initialization fails.
     */
    public function __construct() {
        parent::__construct(_x('Author Block', 'title', ECOMMERCE_TEXT_DOMAINE), 'author-block');

        $this->set_mode('edit');

        // Text fields
        $quote = new Textarea(_x('Quote','field', ECOMMERCE_TEXT_DOMAINE),'quote','quote');
        $author = new Text(_x('Author','field',ECOMMERCE_TEXT_DOMAINE),'author','author');
        $role = new Text(_x('Role', 'field',ECOMMERCE_TEXT_DOMAINE),'role','role');
        $image = new Image(_x('Image', 'field',ECOMMERCE_TEXT_DOMAINE),'image','image');

        // Color settings
        $color_setting = new Accordion(_x('Color settings','field', ECOMMERCE_TEXT_DOMAINE),'color-setting','color-setting');
        $background_color = new Color(_x('Background Color', 'field',ECOMMERCE_TEXT_DOMAINE),'background_color','background_color');
        $text_color = new Color(_x('Text Color','field', ECOMMERCE_TEXT_DOMAINE),'text_color','text_color');

        $color_setting->add_fields([
            $background_color,
            $text_color,
        ]);

        // Add fields to the block
        $this->add_fields([
            $quote,
            $author,
            $role,
            $image,
            $color_setting,
        ]);

        // Set available styles for the block
        $this->set_styles([
            [
                'name' => 'default',
                'label' => _x('Default', 'block style', ECOMMERCE_TEXT_DOMAINE),
                'isDefault' => true,
            ],
            [
                'name' => 'boxed',
                'label' => _x('Boxed', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'minimal',
                'label' =>_x('Minimal', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ]
        ]);

        // Set block category, icon, and keywords
        $this->set_category('layout')
            ->set_icon('admin-comments')
            ->add_keywords(['hero','quote']);

        // Set the renderer class for the block
        $this->set_renderer(new AuthorBlockRenderer());
    }
}
