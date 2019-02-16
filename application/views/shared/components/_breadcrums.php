
<div id="breadcrumbs_container">
    <div id="breadcrums">
         <?php 
            $parse = parse_url($_SERVER['REQUEST_URI']);
            $path = $parse['path'];
            $parts = array_filter(explode('/', $path));
            if (count($parts) === 1) {
                return;
            } else {
                // echo ("<a href=\"/\">webmasterwill</a> &raquo; ");
                for ($i = 1; $i <= count($parts); $i++) {
                    end($parts);         
                    $key = key($parts);
                    if ($i < $key) {
                        echo("<a href=\"/");
                        for ($j = 1; $j <= $i; $j++) {echo strtolower($parts[$j])."/";};
                        echo ucfirst(("\">". str_replace('-', ' ', $parts[$i]))."</a> » ");
                    } else {
                        echo '<b><p>' . ucfirst(str_replace('-', ' ', $parts[$i])) .'</p></b>';
                    };
                };
            };  
        ?>
    </div>
</div>
