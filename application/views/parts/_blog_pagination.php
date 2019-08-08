
    <?php 

    	if (isset($_GET['page_num'])) {
    		$page_num = $_GET['page_num'];
        } else {
            $page_num = 1;
        }

     ?>

<ul id="pagination">
    <li class="<?php if($page_num <= 1){ echo 'disabled'; } ?>"><a href="?page_num=1">First</a></li>
    <li class="<?php if($page_num <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($page_num <= 1){ echo '#'; } else { echo "?page_num=".($page_num - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($page_num >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($page_num >= $total_pages){ echo '#'; } else { echo "?page_num=".($page_num + 1); } ?>">Next</a>
    </li>
    <li class="<?php if($page_num == $total_pages){ echo 'disabled'; } ?>"><a href="?page_num=<?php echo $total_pages; ?>">Last</a></li>
   <!--  <ul>
        <li class="<?php if($page_num == $total_pages){ echo 'disabled'; } ?>"><a href="?page_num=<?php echo $total_pages; ?>"><?php echo $page_num + 1; ?></a></li>
         <li class="<?php if($page_num == $total_pages){ echo 'disabled'; } ?>"><a href="?page_num=<?php echo $total_pages; ?>"><?php echo $page_num + 2; ?></a></li>
    </ul> -->
</ul>

