</main>
<section class="footer">
	<div class="footer-content-wrap">
		<div class="footer-content">
			<div class="footer-top">
				<div class="row collapse align-center">
					<div class="left-section columns small-12 medium-4">
						<?php
						wp_nav_menu(
							[
								'menu'      => 'footer-nav',
								'container' => false,
							]
						)
						?>
					</div>
					<div class="right-section columns small-12 medium-8">
						<a class="large-arrow-link" href="/contact">Let’s chat</a>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="row align-middle collapse">
					<div class="columns small-12 large-8">
						<ul class="social-links">
							<li><a href="https://www.facebook.com/pyxl.inc" target="_blank">Facebook</a></li>
							<li class="slash">/</li>
							<li><a href="https://twitter.com/thinkpyxl" target="_blank">Twitter</a></li>
							<li class="slash">/</li>
							<li><a href="https://www.linkedin.com/company/pyxl/" target="_blank">Linkedin</a></li>
							<li class="slash">/</li>
							<li><a href="https://www.instagram.com/thinkpyxl/" target="_blank">Instagram</a></li>
							<li class="slash">/</li>
							<li><a href="https://plus.google.com/104256573426559889139" target="_blank">Google+</a></li>
						</ul>
					</div>
					<div class="columns small-12 large-4">
						<ul class="legal">
							<li>&copy; <?php echo date( 'Y' ); ?> Pyxl, inc.</li>
							<li class="slash">/</li>
							<li><a href="/privacy-policy">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<a id="footer-anchor"></a>
<script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script>
</div><!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>
