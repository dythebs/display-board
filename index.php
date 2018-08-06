<?php include "./config.php"?>
<html style="height: 100%">
<head>
    <title>Display-Board</title>
    <!--auto refresh-->
    <script language="JavaScript">
        function myrefresh(){
            window.location.reload();
        }
        setTimeout('myrefresh()',<?php echo $autoRefreshRate ?>);
    </script>
    <?php
        function isOpen(){
            $h = date("H") + 0; $m = date("i") + 0;
            global $auto_close, $start_h, $start_m, $end_h, $end_m;
            if(!$auto_close)
                return true;
            $startms = $start_m + $start_h*60;
	        $nowms = $m + $h*60;
	        $endms = $end_m + $end_h*60;
            if($endms < $startms)
            {
                $endms += 24*60;
                if($h <= $end_h)
                    $nowms += 60*24;
            }
            return $nowms<$endms && $nowms>$startms;
        }
    ?>
</head>
<body style="height: 100%">
    <?php
        if(!isOpen()){
            echo '<div style="background: black;width: 100%;height: 100%"></div>';
        }
    ?>
    <div style="width: 50%;float: left;"><?php include "./wunderlist/wunderlist.php"?></div>
    <div style="width: 50%;float: left;"><?php include "./weather/weather.php"?></div>
</body>
</html>