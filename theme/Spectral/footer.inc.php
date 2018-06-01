<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File: 	footer.inc.php
* @Package:	Spectral theme for GetSimple CMS
* @Action:	page footer, footer scripts and closing tags
*
*****************************************************/
?>
				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; <?php get_site_name(); ?></li>
							<li>CMS: <a href="http://get-simple.info">GETSIMPLE</a></li>
							<li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="<?php get_theme_url(); ?>/assets/js/jquery.scrollex.min.js"></script>
			<script src="<?php get_theme_url(); ?>/assets/js/jquery.scrolly.min.js"></script>
			<script src="<?php get_theme_url(); ?>/assets/js/skel.min.js"></script>
			<script src="<?php get_theme_url(); ?>/assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="<?php get_theme_url(); ?>/assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="<?php get_theme_url(); ?>/assets/js/main.js"></script>
		<?php get_footer(); ?>
	</body>
</html>
