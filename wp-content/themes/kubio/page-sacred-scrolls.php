<?php
/*
Template Name: Sacred Scrolls
*/
get_header();
?>
<style>
  .book-card {
    display: flex;
    flex-wrap: wrap;
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    background-color: #fff;
  }

  .book-image {
    flex: 1 1 150px;
    /* padding-right: 20px; */

  }

  .book-image img {
    max-width: 150px;
    height: auto;
    border-radius: 8px;
  }

  .book-content {
    flex: 2 1 300px;
    padding-left: 20px;
    margin-left: auto;
    text-align: left;

  }

  .chapter-list {
    margin-top: 10px;
  }

  .chapter-item {
    margin-bottom: 8px;
  }

  .chapter-item a {
    color: #5f1a60;
    margin-left: 10px;
    text-decoration: underline;
  }

  ul.list-unstyled {
    max-height: none;
    overflow-y: visible;
  }

  .sap-container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
  }

  .book-block {
    margin-bottom: 2rem;
  }

  .book-block img {
    margin-bottom: 0.5rem;
    border-radius: 8px;
  }

  .pagination {
    margin: 2em 0;
  }

  .pagination a,
  .pagination span {
    display: inline-block;
    margin: 0 6px;
    padding: 6px 12px;
    background: #eee;
    color: #333;
    border-radius: 5px;
    text-decoration: none;
  }

  .pagination .current {
    background: #333;
    color: #fff;
  }

  .card {
    margin: 0 auto;
  }

  .card-body {
    padding: 1.5rem;
  }

  .card-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  .card-text {
    font-size: 1rem;
    margin-bottom: 1rem;
  }

  .card-link {
    font-size: 1rem;
    color: #007bff;
    text-decoration: none;
  }

  .card-link:hover {
    text-decoration: underline;
  }

  .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 0.75rem 1.25rem;
    font-size: 1.25rem;
    font-weight: bold;
  }

  .card-header h2 {
    margin: 0;
  }

  .card-header h2 a {
    color: inherit;
    text-decoration: none;
  }

  .card-header h2 a:hover {
    text-decoration: underline;
  }

  .card-header h2 a:visited {
    color: inherit;
  }

  .card-header h2 a:active {
    color: inherit;
  }

  .card-header h2 a:focus {
    outline: none;
  }

  select {
    padding: 0.5rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-left: 10px;
  }

  select:focus {
    outline: none;
    border-color: #007bff;
  }

  .row {
    margin: 0;
  }

  .col-md-12 {
    padding: 0;
  }

  option {
    padding: 0.5rem;
  }
</style>

<div class="sap-container">
  <div class="row">
    <div class="col-md-12 mb-4">
      
      <h3>Books</h3>
      <form method="GET" action="<?php echo esc_url(get_permalink()); ?>" style="margin-bottom: 20px;">
        <label for="book_category_filter"><?php _e('Filter by Category:', 'your-textdomain'); ?></label>
        <select name="book_category_filter" id="book_category_filter" onchange="this.form.submit()">
          <option value=""><?php _e('All Categories', 'your-textdomain'); ?></option>
          <?php
          $terms = get_terms(['taxonomy' => 'book_category', 'hide_empty' => false]);
          foreach ($terms as $term) {
            $selected = (isset($_GET['book_category_filter']) && $_GET['book_category_filter'] == $term->slug) ? 'selected' : '';
            echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
          }
          ?>
        </select>
        <label for="book_filter"><?php _e('Filter by Book:', 'your-textdomain'); ?></label>
        <select name="book_filter" id="book_filter" onchange="this.form.submit()">
          <option value=""><?php _e('All Books', 'your-textdomain'); ?></option>
          <?php
          $books = get_posts([
            'post_type' => 'book',
            'numberposts' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
          ]);
          foreach ($books as $book_option) {
            $selected = (isset($_GET['book_filter']) && $_GET['book_filter'] == $book_option->ID) ? 'selected' : '';
            echo '<option value="' . $book_option->ID . '" ' . $selected . '>' . esc_html($book_option->post_title) . '</option>';
          }
          ?>
        </select>
        <label for="lang">Filter by Language:</label>
        <select name="lang" id="lang" onchange="this.form.submit()">
          <option value="">All Languages</option>
          <option value="English" <?php selected($_GET['lang'] ?? '', 'English'); ?>>English</option>
          <option value="Hindi" <?php selected($_GET['lang'] ?? '', 'Hindi'); ?>>Hindi</option>
          <option value="Sanskrit" <?php selected($_GET['lang'] ?? '', 'Sanskrit'); ?>>Sanskrit</option>
        </select>
        <!-- Reset Filter -->
        <?php if (!empty($_GET['lang'])): ?>
          <a href="<?php echo site_url('/sacred-scrolls'); ?>" style="margin-left: 15px;">Reset Filter</a>
        <?php endif; ?>

      </form>
    </div>

  </div>

  <div class="row justify-content-center" id="book-list">
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $book_filter = isset($_GET['book_filter']) ? $_GET['book_filter'] : '';
    $lang = isset($_GET['lang']) ? sanitize_text_field($_GET['lang']) : '';
    $args = [
      'post_type' => 'book',
      'posts_per_page' => 3,
      'orderby' => 'title',
      'order' => 'ASC',
      'paged' => $paged,
    ];
    if (!empty($_GET['book_category_filter'])) {
      $args['tax_query'] = [
        [
          'taxonomy' => 'book_category',
          'field' => 'slug',
          'terms' => sanitize_text_field($_GET['book_category_filter']),
        ],
      ];
    }
    if ($book_filter) {
      $args['post__in'] = [$book_filter];
    }

    $book_query = new WP_Query($args);

    if ($book_query->have_posts()):
      while ($book_query->have_posts()): $book_query->the_post();
        $book = get_post();
    ?>
        <div class="book-card">
          <div class="book-card-inner">
            <div class="book-image">

              <?php

              $book_image = get_the_post_thumbnail_url($book->ID, 'medium');
              $book_title = get_the_title($book->ID);
              $chapter_args = [
                'post_type' => 'chapter',
                'posts_per_page' => -1, // show all chapters
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'meta_query' => [
                  [
                    'key' => 'related_book',
                    'value' => $book->ID,
                    'compare' => '='
                  ]
                ]
              ];
              if ($lang) {
                $chapter_args['meta_query'][] = [
                  'key' => 'language',
                  'value' => $lang,
                  'compare' => '='
                ];
              }
              $chapter_query = new WP_Query($chapter_args);
              ?>
            </div>
            <div class="chapter-list">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <img src="<?php echo esc_url($book_image); ?>" alt="<?php echo esc_attr($book_title); ?>" style="width: 700PX; height: auto;">
                      <h2 class="card-title">

                        <h2><?php echo esc_html($book_title); ?></h2>
                        <p><strong>Language:</strong> <?php echo get_post_meta(get_the_ID(), 'language', true); ?></p>

                    </div>
                    <div class="card-body">
                      <p class="card-text"><?php echo esc_html(get_the_excerpt($book->ID)); ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <ul class="list-unstyled" style="list-style: none;">
                    <?php
                    $chapters = [];
                    if ($chapter_query->have_posts()) {
                      while ($chapter_query->have_posts()) {
                        $chapter_query->the_post();
                        $chapters[] = get_post();
                      }
                    }
                    if (!empty($chapters)): ?>
                      <?php foreach ($chapters as $chapter): ?>
                        <?php
                        $chapter_image = get_the_post_thumbnail_url($chapter->ID, 'thumbnail');
                        $chapter_title = get_the_title($chapter->ID);
                        $chapter_excerpt = get_the_excerpt($chapter->ID);
                        ?>
                        <li class="chapter-item">
                          <strong><?php echo esc_html($chapter_title); ?></strong>
                          <a href="<?php echo get_permalink($chapter->ID); ?>">Read Chapter</a>
                        </li>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <p>No chapters found for this book.</p>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

    <?php
      endwhile;
      wp_reset_postdata();
    else:
      echo '<p>No books found.</p>';
    endif;
    ?>
  </div>

  <div class="pagination">
    <?php
    echo paginate_links([
      'base' => get_pagenum_link(1) . '%_%',
      'format' => 'page/%#%/',
      'current' => max(1, get_query_var('paged')),
      'total' => $book_query->max_num_pages,
      'prev_text' => '« Prev Books',
      'next_text' => 'Next Books »',
    ]);
    ?>
  </div>
</div>


<?php get_footer(); ?>