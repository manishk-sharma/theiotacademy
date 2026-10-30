<?php get_header(); ?>
<div class="breadcrumb-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
         </div>
      </div>
   </div>
</div>

<div class="container-fluid content-page-body">
   <div class="row">
      <!-- Left Sidebar for TOC -->
      <div class="col-md-2">
	 	<h2 class="contant-page-heading d-block d-lg-none"><?php the_title(); ?></h2>
<div class="main_data d-block d-lg-none mb-4">
            <ul class="group_author">
               <li>
                  <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                  <p>
                     <i>Written By</i> 
                     <span class="anchorlink">
						 <?php the_author(); ?>
					  </span>
                  </p>
               </li>
               <li>
                  <p><i>Published on</i> <span><?php the_time('F jS, Y'); ?></span></p>
               </li>
               <?php if (get_the_date() !== get_the_modified_date()) { ?>
               <li>
                  <p><i>Updated on</i> <span><?php the_modified_date(); ?></span></p>
               </li>
               <?php } ?>
               <li>
                  <i class="icon icon-book-open"></i>
                  <?php echo calculate_reading_time(get_the_content()) . ' Minutes Read'; ?>
               </li>
            </ul>
         </div>
         <?php
         if (have_posts()) : 
            while (have_posts()) : the_post();
               $content = get_the_content();
               $matches = [];
               preg_match_all('/<h([2-3])>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER);
               $toc = '<div id="dynamic-toc" class="sticky-top" style="top: 100px;"><div class="head">Table of Contents</div><ul>';

               if (!empty($matches)) {
                  foreach ($matches as $index => $heading) {
                     $id = 'toc-heading-' . ($index + 1);
                     $level = $heading[1];
                     $text = strip_tags($heading[2]);
                     $content = str_replace($heading[0], "<h$level id=\"$id\">$text</h$level>", $content);
                     $toc .= "<li class=\"toc-level-$level\"><a href=\"#$id\">$text</a></li>";
                  }
               }
               $toc .= '</ul></div>';
               echo $toc;
            endwhile;
         endif;
         ?>
      </div>

      <!-- Main Content -->
      <div class="col-md-7">
         <h1 class="contant-page-heading d-none d-lg-block"><?php the_title(); ?></h1>
         <div class="share-btn-toggle">
             <i class="icon-share-squared" id="share-icon" onclick="toggleShare(true);"></i>
             <i class="icon-cancel-circled" style="display: none;" id="cross-icon" onclick="toggleShare(false);"></i>
         </div>
         <div class="share" id="share-option" style="display: none;">
            <?php wcr_share_buttons(); ?>
         </div>
         <div class="main_data d-none d-lg-block">
            <ul class="group_author">
               <li>
                  <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                  <p>
                     <i>Written By</i> 
                     <span class="anchorlink">
						 <?php the_author(); ?>
					  </span>
                  </p>
               </li>
               <li>
                  <p><i>Published on</i> <span><?php the_time('F jS, Y'); ?></span></p>
               </li>
               <?php if (get_the_date() !== get_the_modified_date()) { ?>
               <li>
                  <p><i>Updated on</i> <span><?php the_modified_date(); ?></span></p>
               </li>
               <?php } ?>
               <li>
                  <i class="icon icon-book-open"></i>
                  <?php echo calculate_reading_time(get_the_content()) . ' Minutes Read'; ?>
               </li>
            </ul>
         </div>
         <div class="post-content">
            <?php echo $content; ?>
         </div>
         <div class="media-box mt-5">
            <p class="p_user_heading">About The Author</p>
            <div class="media">
<div class="d-flex align-items-center gap-2 mb-2">
					<?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
				<div class="h5 mb-0"><?php the_author_posts_link(); ?></div>
				</div>
               
               <div class="media-body mx-2">
<!--                   <div class="h5 mb-2"><?php the_author_posts_link(); ?></div> -->
                  <p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
               </div>
            </div>
         </div>
         <div class="related-posts-sec">
            <?php wcr_related_posts(); ?>
         </div>
      </div>

      <!-- Right Sidebar -->
      <div class="col-md-3">
		  <div class="text-center sticky-top" style="top: 100px;">
<!-- 			  <a href="<?php //echo esc_url($banner_link_url); ?>" target="_blank" rel="nofollow">
					 <img src="<?php //echo esc_url($banner_image_url); ?>" alt="christmas offer image" class="img-fluid img-thumbnail">
				 </a> -->
<!-- 				  <a href="https://www.theiotacademy.co/advanced-generative-ai-course" target="_blank">
					 	<img src="https://www.theiotacademy.co/blog/wp-content/uploads/2025/02/generative-ai-blog-banner.webp" alt="generative Ai image" class="img-fluid img-thumbnail">
			  		</a> -->
<!-- 			  <a href="https://www.theiotacademy.co/short-term-courses" target="_blank">
					 	<img src="https://www.theiotacademy.co/blog/wp-content/uploads/2025/05/Career-Accelerator-Program-01.webp" alt="Career-Accelerator-Program image" class="img-fluid img-thumbnail" width="1209" height="2250">
			  		</a>			   -->
			  <a  href="https://scholarships.theiotacademy.co" target="_blank" >
					 	<img src="https://www.theiotacademy.co/blog/wp-content/uploads/2026/08/83-AI-unleased-webinar-2.webp" alt="AI-unleased-webinar" class="img-fluid img-thumbnail" width="1209" height="2250">
			  		</a>
		  </div>
         <div class="sticky-top" style="top: 800px;">
            <?php if (is_active_sidebar('sidebar-1')) : ?>
            <div id="secondary" class="sidebar-container">
               <div class="widget-area">
                  <?php dynamic_sidebar('sidebar-1'); ?>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>

<script>
function toggleShare(show) {
   const shareOption = document.getElementById('share-option');
   const shareIcon = document.getElementById('share-icon');
   const crossIcon = document.getElementById('cross-icon');
   if (show) {
      shareOption.style.display = 'block';
      shareIcon.style.display = 'none';
      crossIcon.style.display = 'block';
   } else {
      shareOption.style.display = 'none';
      shareIcon.style.display = 'block';
      crossIcon.style.display = 'none';
   }
}

document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('#dynamic-toc a');
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop + 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tocLinks = document.querySelectorAll('#dynamic-toc a');
    const sections = Array.from(tocLinks).map(link => {
        const targetId = link.getAttribute('href').substring(1);
        return document.getElementById(targetId);
    });

    function setActiveLink() {
        let activeIndex = -1;
        const offset = 20;
        const fromTop = window.scrollY + offset;

        sections.forEach((section, index) => {
            if (section && section.offsetTop <= fromTop) {
                activeIndex = index;
            }
        });

        tocLinks.forEach((link, index) => {
            if (index === activeIndex) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
    window.addEventListener('scroll', setActiveLink);
    tocLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - offset,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>


<?php get_footer(); ?>
