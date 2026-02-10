jQuery(function ($) {

    function refresh(card) {
        const availability = card.find('.ck-availability').val();
        const postType = card.find('.ck-post-type-select').val();
        const scope = card.find('.ck-post-scope').val();

        card.find('.ck-dependent').hide();
        card.find('.ck-posts-list').hide();

        if (availability === 'post_type') {
            card.find('.ck-post-type').show();

            if (scope === 'specific' && postType) {
                card.find('.ck-posts-list[data-post-type="' + postType + '"]').show();
            }
        }

        if (availability === 'specific_pages') {
            card.find('.ck-pages').show();
        }
    }

    $('.ck-block-card').each(function () {
        refresh($(this));
    });

    $(document).on('change', 'select', function () {
        refresh($(this).closest('.ck-block-card'));
    });
});
