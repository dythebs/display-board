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
</head>
<body style="height: 100%">
    <div style="width: 50%;float: left;"><?php include "./wunderlist/wunderlist.php"?></div>
    <div style="width: 50%;float: left;"><?php include "./weather/weather.php"?></div>
</body>
</html>