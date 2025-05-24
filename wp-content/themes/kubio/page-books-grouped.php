<?php
/**
 * Template Name: Pages Grouped by Book
 */
get_header();
?>

<div class="book-list">
<?php
$books = get_posts([
    'post_type' => 'book',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
]);

foreach ($books as $book) {
    echo '<h2>' . esc_html($book->post_title) . '</h2>';

    $pages = get_pages();
    $found = false;

    foreach ($pages as $page) {
        $linked_book = get_field('book', $page->ID); // ACF field on the Page

        if ($linked_book && $linked_book->ID == $book->ID) {
            $found = true;
            echo '<li><a href="' . get_permalink($page->ID) . '">' . esc_html($page->post_title) . '</a></li>';
        }
    }

    if (!$found) {
        echo '<p><em>No chapters yet.</em></p>';
    }
}
?>
</div>

<?php get_footer(); ?>
