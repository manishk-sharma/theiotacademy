<?php get_header(); ?>
<section class="search-bg">
    <div class="container-fluid text-center">
         <div class="search-page-header">
               <h1 class="page-title text-center">
                  <?php _e( 'Search results for : ', 'arysonblog' ); ?>
                  <span class="page-description"><?php echo get_search_query(); ?></span>
               </h1>
         </div>
    </div>
</section>
<div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-md-9">
         <div class="row">
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
                           </p>
                           <p class="head-title h4">
                              <a class="fts-1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                           </p>
                           <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                           <div class="name-date-read-more">
                              <div class="name-date-avatar">
                                 <?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?> 
                                 <div class="name-date">
                                       <a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author_meta('display_name');?></a>
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
		 <?php if($counter == 0){echo "<div class='text-center text-danger w-100'><h2>No Result Found</h2></div>";} ?>	
      </div>
      <nav aria-label="Page navigation example">
         <ul class="pagination">
            <li class="page-item"><?php echo paginate_links(); ?></li>
         </ul>
      </nav> 
      </div>
      <div class="col-md-3">
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
