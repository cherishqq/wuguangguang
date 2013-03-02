	</div>
	<div id="footer">
		
		<p><a href="about/" title="关于壁纸云">关于壁纸云</a>  |   <a href="links/" title="友情链接">友情链接</a>&nbsp;&nbsp;
		
		<?php if(stripslashes(get_option('iphoto_copyright'))!=''){echo stripslashes(get_option('iphoto_copyright'));}else{echo 'Copyright &copy; '.date("Y").' '.'<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved';}?>Powered by <a href="http://wordpress.org/" title="Wordpress">WordPress</a> <a href="http://www.moke8.com" target="_blank">moke8</a><a href="http://www.haoaidao.com" target="_blank">love</a></p>
		</div>
	</div><!--end footer-->
<?php wp_footer(); ?>

</body>
</html>