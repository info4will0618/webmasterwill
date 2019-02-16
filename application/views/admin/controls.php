<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';

	$title = "WebMasterWill | Admin"; 
?>


<div class="main-page" id="admin-controls_page">

	<h1>Admin Controls</h1>

	<div id="admin_control-panel">

		<a href="<?php echo $cfg['site']['root']; ?>/admin/view-request">View All Clients Requests</a>

		<a href="<?php echo $cfg['site']['root']; ?>/admin/view-posts">View, Create, Edit, Delete, or Save Blog Posts</a>

		<a href="<?php echo $cfg['site']['root']; ?>/admin-auth/log-out">log out</a>

	</div>

	
</div>

