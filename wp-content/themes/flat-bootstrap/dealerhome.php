<?php  
/* 
Template Name: dealerhome
*/

get_header(); ?>

<?php get_template_part( 'content', 'header' ); ?>
<div class="row blankrow">
<div class="col-sm-12">&nbsp;</div></div>
<div class="greybarbg">
<div class=col-sm-2>&nbsp;</div>
<div class="col-sm-8">
<div class="row">
<div class="col-sm-4"><a href="#" class="whitelink"><div class="blackbuttonbg">
              <h4 align="center">MARKET</h4>
            </div></a></div>
<div class="col-sm-4"><a href="#" class="whitelink"><div class="blackbuttonbg">
              <h4 align="center">SELL</h4>
            </div></a></div>
<div class="col-sm-4"><a href="#" class="whitelink"><div class="blackbuttonbg"><h4 align="center">CMS</h4></div></a>
</div>

</div></div>
<div class="col-sm-12">
<div class="col-sm-2">&nbsp;</div>
</div>
<div class="col-sm-12 secondheading">
<div class=col-sm-2>&nbsp;</div>
<div class="col-sm-8">
<div class="row">
<div class="col-sm-4 online"><a href="#" class="whitelink">
                          <div class="greybuttonbg">
                            <h4 align="center">ONLINE FORMS</h4>
                          </div>
                        </a></div>
<div class="col-sm-3 doucments"><a href="#" class="whitelink">
                          <div class="greybuttonbg">
                            <h4 align="center">DOCUMENTS</h4>
                          </div>
                        </a></div>
<div class="col-sm-3 insureance"><a href="#" class="whitelink">
                          <div class="greybuttonbg">
                            <h4 align="center">INSURANCE</h4>
                          </div>
                        </a></div>
<div class="col-sm-2 email"><a href="#" class="whitelink">
                          <div class="greybuttonbg">
			<h4 align="center">EMAIL</h4>
                          </div>
                        </a></div>

</div></div>
<div class="col-sm-2 short"><label>
                      <select name="select" class="textlist" id="select">
                        <option selected="selected">Sort By</option>
                        <option>American Cars</option>
                        <option>Subcompact</option>
                        <option>Compact</option>
                        <option>Mid-Size</option>
                        <option>Full-Size</option>
                        <option>Sport Car</option>
                      </select>
                    </label></div>
</div>
</div>
<div class="col-sm-12 greybg"><img src="<?php echo get_template_directory_uri(); ?>/images/grey_bg.png" width="5" height="5"></div>


<div class="container">
<div id="main-grid" class="row">

	<div id="primary" class="content-area col-md-10 col-md-push-2">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar( 'left' ); ?>
		
</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
