<?php get_header(); ?>

<section class="home-latest-post">
    <div class="container-fluid">
        <?php 
        // Custom query to get the latest 3 posts
        $args = array(
            'posts_per_page' => 3, // Limit to 3 posts
            'orderby' => 'date', // Order by date
            'order' => 'DESC', // Latest posts first
        );
        $custom_query = new WP_Query($args);

        if ( $custom_query->have_posts() ) : 
            $post_counter = 0; // Initialize counter
        ?>
        <div class="row">
            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); $post_counter++; ?>
                <?php if ( $post_counter === 1 ) : ?>
                    <!-- First Blog Post -->
                    <div class="col-md-6">
                        <div class="post-box latest-blog-1">
                            <a class="index-featured-image" href="<?php the_permalink(); ?>" aria-label="Post link">
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) );
                                } else {
                                    echo main_image(); // Replace with a fallback function or default image
                                } ?> 
                            </a>
                            <div class="post-box-text">
                                <p class="category">
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
                                <a class="head-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <p class="para"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
								<div class="name-date">
									<a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>">By <?php echo get_the_author_meta('display_name');?></a> <span class="date"><i class="icon icon-calendar"></i>&nbsp;<?php the_time('F j, Y'); ?></span>
								</div>								
                            </div>
                        </div>
                    </div>
                <?php elseif ( $post_counter === 2 ) : ?>
                    <!-- Start Second Column -->
                    <div class="col-md-6">
                        <div class="row right-side">
                            <div class="col-md-12">
                                <div class="post-box latest-blog-2">
                                    <!-- Same post structure as above -->
                                    <a class="index-featured-image" href="<?php the_permalink(); ?>" aria-label="Post link">
                                        <?php if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) );
                                        } else {
                                            echo main_image();
                                        } ?> 
                                    </a>
                                    <div class="post-box-text">
                                        <p class="category">
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
										<a class="head-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <div class="name-date">
											<a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author_meta('display_name');?></a> <span class="date"><i class="icon icon-calendar"></i>&nbsp;<?php the_time('F j, Y'); ?></span>
										</div>
									</div>
                                </div>
                            </div>
                <?php else : ?>
                            <div class="col-md-12">
                                <div class="post-box latest-blog-3">
                                    <!-- Same post structure as above -->
                                    <a class="index-featured-image" href="<?php the_permalink(); ?>" aria-label="Post link">
                                        <?php if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) );
                                        } else {
                                            echo main_image();
                                        } ?> 
                                    </a>
                                    <div class="post-box-text">
                                        <p class="category">
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
										<a class="head-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<div class="name-date">
											<a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author_meta('display_name');?></a><span class="date"><i class="icon icon-calendar"></i>&nbsp;<?php the_time('F j, Y'); ?></span>
										</div>
                                    </div>
                                </div>
                            </div>
                <?php endif; ?>
            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>

    <?php 
    // Reset post data
    wp_reset_postdata(); 
    ?>
</section>

<section class="mb-5 d-block d-md-none">
    <div class="container-fluid">
        <div class="w-100 px-4 mb-3">
				<div class="input-group">
					<input type="text" id="searchInput2" class="form-control" placeholder="Search Blog ..." aria-label="Recipient's username" aria-describedby="button-addon2" required="">
					<div class="input-group-append">
					  <button onclick="secrhBtn2()" class="btn btn-outline-secondary" type="button" id="button-addon2" style="background: #03045e; color: #fff;border-radius: .25rem;">Search</button>
					</div>
					<script>
						function secrhBtn2(){
							var searchValue = document.getElementById("searchInput2").value;
							if(!searchValue){
								console.log("please type ...");
							}
							else{
								window.location.href = 'https://www.theiotacademy.co/blog/?s='+searchValue;
							}
						}
					</script>
				</div>
			</div>
    </div>
</section>

<section class="home-banner-sec">
	<div class="container-fluid py-5">
		<h1 class="text-center font-weight-bold">
			POPULAR CATEGORY
		</h1>
		<?php
// Fetch all categories
$categories = get_categories();

if (!empty($categories)) {
    echo '<ul class="category-list">';
    foreach ($categories as $category) {
        // Display category name with a link
        echo '<li>';
        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
        echo esc_html($category->name);
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No categories found.</p>';
}
?>
	</div>
</section>


<!-- container -->
<div class="bg-gray">
   <div class="container-fluid py-5">
	   <div class="row">
		   <div class="col-md-9">
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
								   <p><?php echo wp_trim_words(get_the_excerpt(), 14); ?></p>
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
			  </div>
			  <nav aria-label="Page navigation example">
				 <ul class="pagination">
					<li class="page-item"><?php pagination_bar(); ?></li>
				 </ul>
			  </nav>
		   </div>
		   <div class="col-md-3">
			 <div class="position-sticky" style="top: 100px;">
				 <div class="w-100 mb-3">
					 <form role="search" method="get" action="https://www.theiotacademy.co/blog/" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
						<label class="wp-block-search__label d-none" for="wp-block-search__input-1">Search</label> 
						<div class="wp-block-search__inside-wrapper">
							<input class="form-control" id="wp-block-search__input-1" placeholder="Search Blog..." value="" type="search" name="s" required=""> 
							<button aria-label="Search" class="btn btn-outline-secondary" type="submit" style="background: #03045e; color: #fff;border-radius: .25rem;">Search</button>
						</div>
					</form>
					 
<!-- 				<div class="input-group">
					<input type="text" id="searchInput" class="form-control" placeholder="Search.." aria-label="Recipient's username" aria-describedby="button-addon2" required>
					<div class="input-group-append">
					  <button onclick="secrhBtn()" class="btn btn-outline-secondary" type="button" id="button-addon2" style="background: #03045e; color: #fff;border-radius: .25rem;">Search</button>
					</div>
					<script>
						function secrhBtn(){
							var searchValue = document.getElementById("searchInput").value;
							if(!searchValue){
								console.log("please type ...");
							}
							else{
								window.location.href = 'https://www.theiotacademy.co/blog/?s='+searchValue;
							}
						}
					</script>
				</div> -->
			</div>
				 <div class="text-center">
<!-- 					 <a href="https://www.theiotacademy.co/advanced-generative-ai-course" target="_blank">
					 	<img src="https://www.theiotacademy.co/blog/wp-content/uploads/2025/02/generative-ai-blog-banner.webp" alt="generative Ai image" class="img-fluid img-thumbnail">
			  		</a> -->
<!-- 					 <a href="https://www.theiotacademy.co/short-term-courses" target="_blank">
					 	<img src="https://www.theiotacademy.co/blog/wp-content/uploads/2025/05/Career-Accelerator-Program-01.webp" alt="Career-Accelerator-Program image" class="img-fluid img-thumbnail" width="1209" height="2259">
			  		</a>	 -->

					 <a href="https://scholarships.theiotacademy.co/" target="_blank">
					 	<img src="https://www.theiotacademy.co/blog/wp-content/uploads/2025/08/embedded-offer.webp" alt="Career-Accelerator-Program image" class="img-fluid img-thumbnail" width="1209" height="2259">
			  		</a>
				 </div>
				 <!--
				<div class="course-tabs">
                        <div class="py-2 head-part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 279 65" fill="none">
                                <path d="M0 20.6818H11.4658L17.5808 65H259.126L265.241 20.6818H279L267.534 0H9.1726L0 20.6818Z" fill="#03045E"/>
                                </svg>
                            <p class="name">Digital Marketing Course</p>
                        </div>
                        <ul class="nav nav-tabs justify-content-center border-top border-bottom p-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">3 Months</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">7 Month</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="py-2">
                                    <div class="d-flex align-items-center justify-content-between pb-2">
                                        <p class="d-flex flex-column m-0"><span class="price">₹ 29,499/-</span><span class="gst">Included 18% GST</span></p>
                                        <a href="https://learn.upskillcampus.com/courses/Digital-Marketing-Certification-642d4c84e4b0b11343d40b64" target="_blank" class="btn btn-style" style="background: #03045E;">Buy Course</a>
                                    </div>
                                    <div class="bg-white p-2">
                                        <ul class="m-0 pl-3">
                                            <li>Overview of Digital Marketing</li>
                                            <li>SEO Basic Concepts</li>
                                            <li>SMM and PPC Basics</li>
                                            <li>Content and Email Marketing</li>
											<li>Website Design</li>
                                        	<li>Free Certification</li>
                                        </ul>
                                        <div class="d-flex  align-items-center justify-content-center">
                                            <a href="https://www.theiotacademy.co/digital-marketing-training" target="_blank" class="btn btn-style mr-2" style="background: #383be5;">All&nbsp;Details</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="py-2">
                                    <div class="d-flex align-items-center justify-content-between pb-2">
                                        <p class="d-flex flex-column m-0"><span class="price">₹ 41,299/-</span><span class="gst">Included 18% GST</span></p>
                                        <a href="https://learn.upskillcampus.com/courses/Digital-Marketing-Certification-642d4c84e4b0b11343d40b64" target="_blank" class="btn btn-style" style="background: #03045E;">Buy Course</a>
                                    </div>
                                    <div class="bg-white p-2">
                                        <ul class="m-0 pl-3">
                                            <li>Fundamentals of Digital Marketing</li>
                                            <li>Core SEO, SMM, and SMO</li>
                                            <li>Google Ads and Meta Ads</li>
                                            <li>ORM & Content Marketing</li>
											<li>3 Month Internship</li>
											<li>Free Certification</li>
                                        </ul>
                                        <div class="d-flex  align-items-center justify-content-center">
                                            <a href="https://www.theiotacademy.co/digital-marketing-training" target="_blank" class="btn btn-style mr-2" style="background: #383be5;">All&nbsp;Details</a> 
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="text-center py-3">
                            <a href="https://www.theiotacademy.co/contact" target="_blank" class="btn btn-style" style="background: #03045E;">Enquire Now</a>
                            <a href="https://www.theiotacademy.co/digital-marketing-training#dm-review" target="_blank" class="btn btn-style" style="background: #03045E;">Testimonials</a>
                            <a href=" https://www.theiotacademy.co/digital-marketing-training" target="_blank" class="btn btn-style" style="background: #03045E;">Download Brochure</a>
                        </div>
                        <div class="trusted border-top">
                            <span class="name">Trusted By</span>
                            <span class="doted-line"></span>
                        </div>
                        <div class="d-flex justify-content-around align-items-center">
                            <img src="https://www.theiotacademy.co/blog/wp-content/uploads/2023/10/client-icon.png" alt="client icon" width="109" height="37" class="img-fluid">
                            <img src="https://www.theiotacademy.co/blog/wp-content/uploads/2023/10/trustpilot-logo.png" alt="trust pilot" width="113" height="27" class="img-fluid">
                        </div>
                    </div>
				 -->
                    <!--courses tab end-->
			 </div>
		  </div>
	   </div>
   </div>
</div>



<?php get_footer(); ?>