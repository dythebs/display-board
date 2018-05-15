<?php include './config.php'; ?>
<link rel="stylesheet" type="text/css" href="./wunderlist/css.css">
<div class="wlapp-parent chrome animate platform-windows application-main background-06 focus-browser" style="height:100%;width: 100%;opacity: 1;background-image: url(./wunderlist/wunderlistbg.png);background-size:cover;background-position: center" role="application" id="wunderlist-base">

    <div id="tasks" role="main">
        <div id="list-toolbar">
            <h1 class="title"><?php echo $listTitle ?></h1>
        </div>
    </div>

    <div class="tasks-scroll">
        <div class="addTask">
        </div>
    </div>

    <div style="margin-left: 1%;margin-right: 1%;margin-top: 3%">
        <ol class="tasks">

            <?php
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_URL, 'http://a.wunderlist.com/api/v1/tasks?list_id='.$list_id);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $header = ["x-access-token: $x_access_token","x-client-id : $x_client_id"];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $file_contents = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($file_contents,true);

            function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_STRING ){
                if(is_array($arrays)){
                    foreach ($arrays as $array){
                        if(is_array($array)){
                            $key_arrays[] = $array[$sort_key];
                        }else{
                            return false;
                        }
                    }
                }else{
                    return false;
                }
                array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
                return $arrays;
            }
            #make sure every object have the date property so that can sort by it
            for($i = 0 ; $i < count($arr) ; $i++){
                if(!array_key_exists('due_date',$arr[$i])){
                    $arr[$i]['due_date'] = date("Y-m-d");
                }
            }

            $arr = my_sort($arr,'due_date');

            foreach ($arr as $item){
                echo <<<str
<li tabindex="0" class="taskItem">
                <div class="taskItem-body">

                    <a class="taskItem-checkboxWrapper checkBox" tabindex="-1" aria-hidden="true"></a>

                    <div class="taskItem-titleWrapper" tabindex="-1" aria-hidden="true">
                        <span class="taskItem-titleWrapper-title">
str;

                echo $item['title'];
                echo <<<str
</span>
                    </div>

                    <span class="taskItem-duedate">
          <text>
str;

                echo $item['due_date'];
                echo <<<str
</text>
         </span>

                    <a class="taskItem-star" tabindex="-1" aria-hidden="true"> <span class="star-wrapper " data-key-title="contextual_mark_as_starred" title="标记为星标">
           <svg width="18px" height="18px" viewbox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
           </svg> </span>
                    </a>

                </div>
            </li>
            <div style="min-height: 1%"/> 
str;

            }
            ?>
            
        </ol>
    </div>
</div>
