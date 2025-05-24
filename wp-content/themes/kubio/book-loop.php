<?php
$paged = isset($_POST['paged']) ? intval($_POST['paged']) : (get_query_var('paged') ?: 1);
$book_filter = isset($_POST['book_filter']) ? intval($_POST['book_filter']) : '';

$args = [
  'post_type' => 'book',
  'posts_per_page' => 3,
  'paged' => $paged,
  'orderby' => 'title',
  'order' => 'ASC',
];

if ($book_filter) {
  $args['post__in'] = [$book_filter];
}

$book_query = new WP_Query($args);
?>

<div class="row justify-content-center" id="book-list">
  <?php if ($book_query->have_posts()) : while ($book_query->have_posts()) : $book_query->the_post(); ?>
      <div class="book-card">
        <div class="book-image">
          <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>">
          <?php endif; ?>
        </div>
        <div class="book-content">
          <h2 style="text-align:center;"><?php the_title(); ?></h2>
          <p><?php echo wp_trim_words(get_field('book_summary'), 20, '...'); ?></p>
          <div class="chapter-list">
            <?php
            $chapters = new WP_Query([
              'post_type' => 'chapter',
              'posts_per_page' => 3,
              'meta_query' => [
                [
                  'key' => 'related_book',
                  'value' => get_the_ID(),
                  'compare' => '='
                ]
              ]
            ]);

            if ($chapters->have_posts()) :
              while ($chapters->have_posts()) : $chapters->the_post(); ?>
                <div class="chapter-item">
                  <strong><?php the_title(); ?></strong> - <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>">Read Chapter</a>
                </div>
            <?php endwhile;
              wp_reset_postdata();
            else :
              echo '<p>No chapters found.</p>';
            endif;
            ?>
          </div>
        </div>
      </div>
  <?php endwhile;
    wp_reset_postdata();
  else :
    echo '<p>No books found.</p>';
  endif; ?>
</div>

<?php
$total_pages = $book_query->max_num_pages;
if ($total_pages > 1) :
?>
  <div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
      <a href="#" data-page="<?php echo $i; ?>" class="<?php echo $paged == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
<?php endif; ?>
