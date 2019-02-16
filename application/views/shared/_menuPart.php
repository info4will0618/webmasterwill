<?php
	$pages = array();
	$pages["index"]="Home";
	$pages["about"]="About";
	$pages["blog"]="Blog";
	$pages["contact"]="Contact";	
	$pages["services"]="Services";
	$pages["reviews"]="Reviews";
?>
<nav id="header_nav-menu_nav">
	<ul id="header_nav-menu_ul">
		<li>
			<a href="/webmasterwill">
				Home
			</a>
		</li>
		<li>
		</li>
		<li>
			<a href="/webmasterwill/about">
				About
			</a>
		</li>
		<li>
			<a href="/webmasterwill/blog">
				Blog
			</a>
		</li>
		<li>
			<a href="/webmasterwill/request">
				Request
			</a>
		</li>
		<li>
			<a href="/webmasterwill/services">
				Services
			</a>
		</li>
		<li>
			<a href="/webmasterwill/reviews">
				Reviews
			</a>

		</li>
	</ul>	
</nav>		


<!-- <nav id="header_nav-menu_nav">
	<ul id="header_nav-menu_ul">
		<?php foreach($pages as $link=>$title) {
				 $current = ($this->_controller==$link) ? " class='current'" : "";
				 $addr = $link == 'index' ? '' : $link;
				 echo "<li{$current}><a class='link' href=". $cfg['site']['root'] . "/{$addr}>{$title}</a></li>";
		      }			
		?>
	</ul>	
</nav>		 -->
