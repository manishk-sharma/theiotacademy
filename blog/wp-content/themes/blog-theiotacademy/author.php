<?php get_header(); ?> 
<section class="authour-bg" id="top_up">
     <div class="container-fluid text-center">
         <h1 class="author_heading">author</h1>
    </div>
</section>

<div class="container-fluid">
   <div class="row">
      <div class="col-lg-9 pb-5">
		<div class="row">
             <div class="author_bio">
               <p class="author_name"><?php echo get_the_author(); ?></p>
               <p class="author_topinfo"><?php echo esc_attr( get_the_author_meta( 'etitle' ) ); ?></p>
               <p class="author-description"><?php esc_textarea(the_author_meta('description'));?></p>
				 <div class="author_post_heading">Author Post</div>
                </div>
            </div>
         <div class="row post-bg">
            <?php if ( $wp_query->have_posts() ) : ?>
            <?php 
               $counter=0;
               $total_posts = $wp_query->post_count;
               $posts_per_column = ceil($total_posts / 1);
               ?>
            <div class="col-sm-12">
                  <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); $counter++; ?>         
                           <div class="post-box author-postblog">
							<div class="row">
								<div class="col-sm-5">
								<a class="index-featured-image" href="<?php the_permalink(); ?>"><?php
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) ); // show featured image
								} 
								?></a>
								</div>
								<div class="col-md-7">
								    <p class="index-category"><i class="icon-tags"></i>
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
								    </p>
								    <h4 class="head-title"><a class="fts-1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								    <div class="name-date-read-more mr-3">
                                        <div class="name-date-avatar">
                                            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?> 
                                            <div class="name-date">
                                                <a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author_meta('display_name');?></a>
                                                <span class="date">
                                                    <!--<i class="icon icon-calendar"></i>&nbsp;-->
                                                    <?php the_time('F j, Y'); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="index-read-more">
                                            <a href="<?php the_permalink(); ?>">Read&nbsp;More</a>
                                        </div>
                                    </div>
								<?php /*the_excerpt();*/ ?>
								</div>
								</div>
                           </div>
                  <!-- Close and open div if the "counter" divided by the "posts per column" of columns you want equals zero -->
                  <?php if($counter % $posts_per_column == 0) echo '</div><div class="col-sm-12">'; ?>
                  <?php endwhile; ?>
            </div>
         </div>
         <?php endif; ?>
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