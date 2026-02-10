<?php

namespace EcommerceBlocks\HeroBlock;

use Exception;
use Geniem\ACF\Block;
use Geniem\ACF\Field\Group;
use Geniem\ACF\Field\Image;
use Geniem\ACF\Field\Repeater;
use Geniem\ACF\Field\Text;
use Geniem\ACF\Field\Textarea;
use Geniem\ACF\Field\URL;

/**
 * Class HeroBlock
 *
 * Defines a customizable Hero Gutenberg block with slider functionality.
 *
 * The block allows content editors to create multiple slides, each containing:
 * - An image
 * - A title
 * - A description
 * - An optional call-to-action button (text + link)
 *
 * Multiple predefined block styles are available to support
 * different homepage and hero layouts.
 *
 * @package EcommerceBlocks\HeroBlock
 */
class HeroBlock extends Block {

    /**
     * HeroBlock constructor.
     *
     * Registers the Hero Block, configures its fields, styles,
     * category, icon, and editor behavior.
     *
     * Uses an ACF Repeater field to allow multiple slides,
     * each with its own content and button configuration.
     *
     * @throws Exception If block registration or field setup fails.
     */
    public function __construct() {
        parent::__construct( _x( 'Hero Block', 'title', ECOMMERCE_TEXT_DOMAINE ), 'hero-block' );

        $this->set_mode('edit');

        // Slider repeater
        $repeater = new Repeater(__('Slider', ECOMMERCE_TEXT_DOMAINE),'slider','slider');

        // Slide fields
        $picture = new Image(__('Picture', ECOMMERCE_TEXT_DOMAINE),'picture','picture');
        $title = new Text(__('Title', ECOMMERCE_TEXT_DOMAINE),'title','title');
        $description = new Textarea(__('Description', ECOMMERCE_TEXT_DOMAINE),'description','description');

        // Button group
        $btn_group = new Group(__('Button', ECOMMERCE_TEXT_DOMAINE),'button');
        $btn_text = new Text(__('Button Text', ECOMMERCE_TEXT_DOMAINE),'button-text','button-text');
        $btn_link = new URL(__('Button Link', ECOMMERCE_TEXT_DOMAINE),'button-link','button-link');

        $btn_group->add_fields([
            $btn_text,
            $btn_link
        ]);

        // Attach fields to repeater
        $repeater->add_fields([
            $picture,
            $title,
            $description,
            $btn_group,
        ]);

        $repeater->set_layout('row');

        // Register repeater field
        $this->add_field($repeater);

        // Define available block styles
        $this->set_styles([
            [
                'name' => 'home_1',
                'label' => _x('Home 1', 'block style', ECOMMERCE_TEXT_DOMAINE),
                'isDefault' => true,
            ],
            [
                'name' => 'home_2',
                'label' => _x('Home 2', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'home_3',
                'label' =>_x('Home 3', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'home_4',
                'label' => _x('Home 4', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'home_5',
                'label' =>_x('Home 5', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'home_6',
                'label' => _x('Home 6', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'home_7',
                'label' =>_x('Home 7', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ],
            [
                'name' => 'home_8',
                'label' =>_x('Home 8', 'block style', ECOMMERCE_TEXT_DOMAINE),
            ]
        ]);

        // Block UI settings
        $this->set_category('layout')
            ->set_icon('slides')
            ->add_keywords(['hero','slider']);
    }
}
