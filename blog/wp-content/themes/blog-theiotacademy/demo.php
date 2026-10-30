<?php get_header(); ?>
<div class="container-fluid">
	<div class="row">
		
	</div>
</div>
<div class="container-fluid">
		<?php if ( $wp_query->have_posts() ) : ?>
        <?php 
            $counter=0;
            $total_posts = $wp_query->post_count;
            $posts_per_column = ceil($total_posts / 3);
        ?>
      <div class="row custom-gutter-faq">
        <div class="col-lg-4">
          <div class="col-lg-12">
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); $counter++; ?>                 
              <div class="faq-all">
                <div class="faq-item">
                  <div class="pt-2 pb-2">
					<span class="tag_btn">
						<?php
							$categories = get_the_category();
							$separator = "";
							$catoptions = '';
							if($categories){
								foreach($categories as $category){
								$catoptions .= '<a href="' .get_category_link($category->term_id). '">'.$category->cat_name. '</a>'.$separator;
							}
								echo trim($catoptions, $separator);
							}
						?>
					</span>
					<div class="post-box">
					<a href="<?php the_permalink(); ?>"><?php
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) ); // show featured image
						} 
					?></a>
					<h4><a class="fts-1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p class="no-margin"><?php echo get_avatar( $id_or_email, $size, $default, $alt, $args ); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author_meta('nickname');?></a>&nbsp;&nbsp; <?php the_time('F j, Y'); ?></p>
					<?php the_excerpt(); ?>
				</div>
				</div>
                </div>
              </div> 
                <!-- Close and open div if the "counter" divided by the "posts per column" of columns you want equals zero -->
                <?php if($counter % $posts_per_column == 0) echo '</div></div><div class="col-lg-4"><div class="col-lg-12">'; ?>
                <?php endwhile; ?>
            </div>
        </div>
      </div>
    <?php endif; ?>
</div>
<div class="container-fluid">
	<div class="row">
		
	</div>
</div>
<?php get_footer(); ?>