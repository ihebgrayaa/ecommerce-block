<?php

namespace EcommerceBlock;

use Exception;

class Kernel
{
    const OPTION_KEY = 'commercekit_active_blocks';

    /* -------------------------------------------------------------------------
     * BOOT
     * ---------------------------------------------------------------------- */
    public static function boot(): void
    {
        add_action('init', [self::class, 'registerBlocks'], 10);
        add_action('admin_menu', [self::class, 'registerAdminMenu']);
        add_action('admin_enqueue_scripts', [self::class, 'enqueueAdminAssets']);
    }

    /* -------------------------------------------------------------------------
     * REGISTER BLOCKS
     * ---------------------------------------------------------------------- */
    public static function registerBlocks(): void
    {
        $active = get_option(self::OPTION_KEY, []);

        $addons = glob(ECOMMERCE_BLOCK_PATH . 'addons/*', GLOB_ONLYDIR);
        if (!$addons) return;

        foreach ($addons as $addonDir) {

            $slug  = basename($addonDir);
            $class = "\\EcommerceBlocks\\{$slug}\\{$slug}";

            if (empty($active[$slug])) continue;
            if (!class_exists($class)) continue;

            try {
                (new $class())->register();
            } catch (Exception $e) {
                error_log('[CommerceKit] ' . $e->getMessage());
            }
        }
    }

    /* -------------------------------------------------------------------------
     * ADMIN MENU
     * ---------------------------------------------------------------------- */
    public static function registerAdminMenu(): void
    {
        add_menu_page(
                'CommerceKit',
                'CommerceKit',
                'manage_options',
                'commercekit',
                null,
                'dashicons-screenoptions',
                58
        );

        add_submenu_page(
                'commercekit',
                'Blocks',
                'Blocks',
                'manage_options',
                'commercekit-blocks',
                [self::class, 'renderBlocksPage']
        );
    }

    /* -------------------------------------------------------------------------
     * ADMIN ASSETS
     * ---------------------------------------------------------------------- */
    public static function enqueueAdminAssets($hook): void
    {
        if (!str_contains($hook, 'commercekit-blocks')) return;

        wp_enqueue_style(
                'commercekit-admin',
                ECOMMERCE_BLOCK_URL . 'assets/css/admin-blocks.css',
                [],
                '1.0'
        );
    }

    /* -------------------------------------------------------------------------
     * BLOCKS PAGE (FLEX UI)
     * ---------------------------------------------------------------------- */
    public static function renderBlocksPage(): void
    {
        if (isset($_POST['commercekit_save'])) {
            update_option(self::OPTION_KEY, $_POST['blocks'] ?? []);
            echo '<div class="updated notice"><p>Saved successfully</p></div>';
        }

        $active = get_option(self::OPTION_KEY, []);
        $blocks = self::getAvailableBlocks();
        ?>

        <div class="wrap commercekit-wrap">
            <h1>CommerceKit – Blocks</h1>

            <form method="post">
                <div class="ck-blocks-grid">

                    <?php foreach ($blocks as $slug => $label): ?>
                        <div class="ck-block-card">
                            <label class="ck-block-title">
                                <input type="checkbox"
                                       name="blocks[<?= esc_attr($slug) ?>]"
                                       value="1"
                                        <?= checked(!empty($active[$slug]), true, false) ?>>
                                <?= esc_html($label) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                </div>

                <p style="margin-top:20px;">
                    <button class="button button-primary" name="commercekit_save">
                        Save
                    </button>
                </p>
            </form>
        </div>
        <?php
    }

    /* -------------------------------------------------------------------------
     * HELPERS
     * ---------------------------------------------------------------------- */
    private static function getAvailableBlocks(): array
    {
        $blocks = [];
        $addons = glob(ECOMMERCE_BLOCK_PATH . 'addons/*', GLOB_ONLYDIR);

        foreach ($addons as $addonDir) {
            $slug = basename($addonDir);
            $blocks[$slug] = ucfirst($slug);
        }

        return $blocks;
    }
}
