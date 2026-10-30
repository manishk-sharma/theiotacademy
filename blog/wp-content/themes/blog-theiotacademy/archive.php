<?php get_header(); ?>
<section class="archive-bg">
    <div class="container-fluid text-center">
    	<div class="archive-page-header">
			<h1 class="page-title text-center">
    			<?php
    					if (is_category()){
    						echo 'Category: ' . single_cat_title( '', false);
    					} elseif(is_tag()){
    						single_tag_title();
    					} elseif(is_author()){
    						the_post();
    						echo 'Author:' .get_the_author();
    						rewind_posts();
    					} elseif( is_day()){
    						echo 'Daily Archives:' .get_the_date();
    					} elseif( is_month()){
    						echo 'Monthly Archives:' .get_the_date('F j, Y g:i, a');
    					} elseif (is_year()){
    						echo 'Yearly Archives:' .get_the_date('y');
    					} else{
    						echo 'Archives';
    					}
    				?>
    		</h1>
    	</div>
    </div>
</section>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-9">
         <div class="row justify-content-center">
         <?php if ( $wp_query->have_posts() ) : ?>
            <?php 
               $counter=0;
               $total_posts = $wp_query->post_count;
               $posts_per_column = ceil($total_posts / 2);
               ?>
               
               <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); $counter++; ?>    
                  
                  <div class="col-md-6">            
                     <div class="post-box">
                        <a class="index-featured-image" href="<?php the_permalink(); ?>" aria-label="Post link">
								  <?php if ( has_post_thumbnail() ) {
									  the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) );
									} else {
									   echo main_image();
									} ?> 
							   </a>
                        <div class="post-box-text">
							      <p class="index-category">
                              <span class="date border-right pr-2"><i class="icon icon-calendar"></i>&nbsp;<?php the_time('F j, Y'); ?></span>
                              <span>
                                 <?php
                                    $categories = get_the_category();
                                    $separator = "";
                                    $catoptions = '';
                                    if($categories){
                                       foreach($categories as $category){
                                       $catoptions .= '<a href="' .get_category_link($category->term_id). '"><i class="icon-tags"></i>'.$category->cat_name. '</a>'.$separator;
                                    }
                                       echo trim($catoptions, $separator);
                                    }
                                 ?>
                              </span>
<!-- 								<span class="date pl-2"><i class="icon icon-eye"></i>&nbsp;<?php //gt_get_post_view(); ?></span> -->
                           </p>
                           <p class="head-title h4">
                              <a class="fts-1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                           </p>
                           <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                           <div class="name-date-read-more">
                              <div class="name-date-avatar">
                                 <?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?> 
                                 <div class="name-date">
									 <?php
										$author_id = get_the_author_meta('ID');
										$author_name = get_the_author_meta('display_name');

										if ( ! empty( $author_name ) ) : ?>
										   <a class="name" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
											  <?php echo esc_html( $author_name ); ?>
										   </a>
										<?php else : ?>
										   <span class="no-author">The IoT Academy</span>
										<?php endif; ?>
<!--                                        <a class="name" href="<?php //echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php //echo get_the_author_meta('display_name');?></a> -->
                                 </div>
                              </div>
                              <div class="index-read-more">
                                 <a href="<?php the_permalink(); ?>">Read&nbsp;More</a>
                              </div>
                           </div>
                        </div>
                  </div>
                  </div>
               <?php if($counter % $posts_per_column == 0) ?>
            <?php endwhile; ?>
         <?php endif; ?>
      </div>
         <nav aria-label="Page navigation example">
            <ul class="pagination">
               <li class="page-item"><?php pagination_bar(); ?></li>
            </ul>
         </nav>
      </div>
      <div class="col-lg-3">
         <div class="content_right_sec1">
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div id="secondary" class="sidebar-container" role="complementry">
               <div class="widget-area">
                  <?php dynamic_sidebar( 'sidebar-1' ); ?>
               </div>
            </div>
            <div id="secondary" class="sidebar-container" role="complementry">
               <div class="widget-area">
                  <?php dynamic_sidebar( 'sidebar-2' ); ?>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>
<?php get_footer(); ?>