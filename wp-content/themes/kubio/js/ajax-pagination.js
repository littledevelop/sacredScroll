jQuery(document).ready(function($) {
    $('#load-more-books').on('click', function() {
        var button = $(this);
        var page = button.data('page');

        $.ajax({
            url: sacred_scrolls_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_books',
                page: page,
                lang: sacred_scrolls_ajax.lang
            },
            beforeSend: function() {
                button.text('Loading...');
            },
            success: function(response) {
                if (response.trim() !== '') {
                    $('#book-list').append(response);
                    button.text('Load More');
                    button.data('page', page + 1);
                } else {
                    button.text('No more books').prop('disabled', true);
                }
            }
        });
    });
});
