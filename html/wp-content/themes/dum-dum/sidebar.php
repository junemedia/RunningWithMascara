<div class="sidebar">
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div>
    	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" /><input type="image" src="<?php bloginfo('template_url'); ?>/images/search-button.jpg" id="searchsubmit" value="Search" />
	</div>
	</form>
<a href="http://www.supersurveysdaily.com/dispatch2.asp?home=1839-29126S-L2" target="_blank"><img src="http://pics.fitandfabliving.com/fit&fab_small_newsletter_2-.gif" width="225" align="center"></a><br/>
<br/>



<?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar('Box-1')):else: ?>
	<div class="box1">
		<div class="box1text">
		<ul>
			<?php wp_list_categories('show_count=0&title_li=<h2>Categories</h2>'); ?>
		</ul>
		</div> <!-- BOX1 TEXT -->
	</div> <!-- BOX1 -->
<?php endif; ?>

<?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar('Box-2')):else: ?>
	<div class="box2">
		<div class="box2text">
		<ul>
			<li><h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
		</ul>
		</div> <!-- BOX2 TEXT -->
	</div> <!-- BOX2 -->
<?php endif; ?>

<?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar('Box-3')):else: ?>
	<div class="box3">
		<div class="box3text">
		<ul>
			<?php wp_list_bookmarks(); ?>
		</ul>
		</div> <!-- BOX3 TEXT -->
	</div> <!-- BOX3 -->

<?php endif; ?>

<?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar('Box-4')):else: ?>
	<div class="box4">
		<div class="box4text">
		<ul>
			<?php wp_list_categories('show_count=0&title_li=<h2>Categories</h2>'); ?>
		</ul>
		</div> <!-- BOX4 TEXT -->
	</div> <!-- BOX4 -->
<?php endif; ?>
<br>






<script type="text/javascript" 

src="http://theblogfrog.com/widgets/blogfrogstyle.js" > </script> <script 

type="text/javascript"> BlogFrogUserID = 40539; BlogFrogBlogID = 1389318; 

BlogFrogColor = "E0CFA3"; BlogFrogLinkColor = "009936"; BlogFrogTextColor = 

"000000"; BlogFrogN = 3; BlogFrogWidth = 220; BlogFrogSample = "no"; 

BlogFrogTitle = "The Fit and Fab Living Community"; BlogFrogIntro = "Join me in"; 

BlogFrogShowProfile = "false"; </script><script type="text/javascript" 

src="http://theblogfrog.com/widgets/bfsupporterswforum.js"></script>

<?php if (function_exists('dynamic_sidebar')&&dynamic_sidebar('Box-5')):else: ?>
	<div class="box5">
		<div class="box5text">
		
		</div> <!-- BOX5 TEXT -->
	</div> <!-- BOX5 -->
<?php endif; ?>

<ul>

<?php wp_list_categories('show_count=0&title_li=<h2>Categories</h2>'); ?>
		</ul>


<align="center">
<script type="text/javascript"><!--
google_ad_client = "pub-7049968558998359";
/* RWM_160x600 */
google_ad_slot = "9833419037";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</align>



</div> 

<!-- SIDEBAR -->