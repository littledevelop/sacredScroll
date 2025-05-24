<form method="GET" id="language-filter">
  <select name="lang" onchange="this.form.submit()">
    <option value="">All Languages</option>
    <option value="English" <?php selected($_GET['lang'], 'English'); ?>>English</option>
    <option value="Hindi" <?php selected($_GET['lang'], 'Hindi'); ?>>Hindi</option>
    <option value="Sanskrit" <?php selected($_GET['lang'], 'Sanskrit'); ?>>Sanskrit</option>
  </select>
</form>
<?php
// Get the current book ID
$book_id = get_the_ID();

// Get current pagination page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// WP_Query for chapters related to this book
$args = array(
    'post_type' => 'page',
    'posts_per_page' => 5, // change as needed
    'paged' => $paged,
    'meta_key' => 'related_book',
    'meta_value' => $book_id,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);
$chapters_query = new WP_Query($args);

// Start loop
if ($chapters_query->have_posts()) : ?>
    <ul class="chapter-list">
        <?php while ($chapters_query->have_posts()) : $chapters_query->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
    </ul>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total' => $chapters_query->max_num_pages,
            'current' => $paged,
            'prev_text' => __('« Prev'),
            'next_text' => __('Next »')
        ));
        ?>
    </div>

<?php else : ?>
    <p>No chapters found.</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
