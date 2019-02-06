<?php
namespace App\Library {
    class Custom_function {
        public function myPagination($total = 0, $per_page = 10, $page = 1, $url = '?') {
            $total = $total;

            $adjacents = "2";

            $prevlabel = "&lsaquo; Prev";
            $nextlabel = "Next &rsaquo;";
            $lastlabel = "Last &rsaquo;&rsaquo;";

            $page = ($page == 0 ? 1 : $page);
            $start = ($page - 1) * $per_page;

            $prev = $page - 1;
            $next = $page + 1;

            $lastpage = ceil($total / $per_page);

            if ($lastpage < 2) {
                return '';
            }
            $lpm1 = $lastpage - 1; // //last page minus 1

            $pagination = "";
            if ($lastpage > 1) {
                $pagination .= "<ul class='pagination'>";
                $pagination .= "<li class='page_info'><span>Page {$page} of {$lastpage}</span></li>";

                if ($page > 1)
                    $pagination.= "<li><a href='{$url}/page/{$prev}' id='GoSearchPagi' page='{$prev}'>{$prevlabel}</a></li>";

                if ($lastpage < 7 + ($adjacents * 2)) {
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}/page/{$counter}' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                    }
                } elseif ($lastpage > 5 + ($adjacents * 2)) {

                    if ($page < 1 + ($adjacents * 2)) {

                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                            else
                                $pagination.= "<li><a href='{$url}/page/{$counter}' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                        }
                        $pagination.= "<li class='dot'>...</li>";
                        $pagination.= "<li><a href='{$url}/page/{$lpm1}' id='GoSearchPagi' page='{$lpm1}'>{$lpm1}</a></li>";
                        $pagination.= "<li><a href='{$url}/page/{$lastpage}' id='GoSearchPagi' page='{$lastpage}'>{$lastpage}</a></li>";
                    } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                        $pagination.= "<li><a href='{$url}' id='GoSearchPagi' page='1'>1</a></li>";
                        $pagination.= "<li><a href='{$url}/page/2' id='GoSearchPagi' page='2'>2</a></li>";
                        $pagination.= "<li class='dot'>...</li>";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                            else
                                $pagination.= "<li><a href='{$url}/page/{$counter}' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                        }
                        $pagination.= "<li class='dot'>..</li>";
                        $pagination.= "<li><a href='{$url}/page/{$lpm1}' id='GoSearchPagi' page='{$lpm1}'>{$lpm1}</a></li>";
                        $pagination.= "<li><a href='{$url}/page/{$lastpage}' id='GoSearchPagi' page='{$lastpage}'>{$lastpage}</a></li>";
                    } else {

                        $pagination.= "<li><a href='{$url}' id='GoSearchPagi' page='1'>1</a></li>";
                        $pagination.= "<li><a href='{$url}/page/2' id='GoSearchPagi' page='2'>2</a></li>";
                        $pagination.= "<li class='dot'>..</li>";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                            else
                                $pagination.= "<li><a href='{$url}/page/{$counter}' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                        }
                    }
                }

                if ($page < $counter - 1) {
                    $pagination.= "<li><a href='{$url}/page/{$next}' id='GoSearchPagi' page='{$next}'>{$nextlabel}</a></li>";
                    $pagination.= "<li><a href='{$url}/page/{$lastpage}' id='GoSearchPagi' page='{$lastpage}'>{$lastlabel}</a></li>";
                }

                $pagination.= "</ul>";
            }

            return $pagination;
        }

        public function myPaginationAjax($total = 0, $per_page = 10, $page = 1, $url = '?') {
            $total = $total;

            $adjacents = "2";

            $prevlabel = "&lsaquo; Prev";
            $nextlabel = "Next &rsaquo;";
            $lastlabel = "Last &rsaquo;&rsaquo;";

            $page = ($page == 0 ? 1 : $page);
            $start = ($page - 1) * $per_page;

            $prev = $page - 1;
            $next = $page + 1;

            $lastpage = ceil($total / $per_page);

            if ($lastpage < 2) {
                return '';
            }
            $lpm1 = $lastpage - 1; // //last page minus 1

            $pagination = "";
            if ($lastpage > 1) {
                $pagination .= "<ul class='pagination'>";
                $pagination .= "<li class='page_info'><span>Page {$page} of {$lastpage}</span></li>";

                if ($page > 1)
                    $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$prev}'>{$prevlabel}</a></li>";

                if ($lastpage < 7 + ($adjacents * 2)) {
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                    }
                } elseif ($lastpage > 5 + ($adjacents * 2)) {

                    if ($page < 1 + ($adjacents * 2)) {

                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                            else
                                $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                        }
                        // $pagination.= "<li class='dot'>...</li>";
                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$lpm1}'>{$lpm1}</a></li>";
                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$lastpage}'>{$lastpage}</a></li>";
                    } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='1'>1</a></li>";
                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='2'>2</a></li>";
                        $pagination.= "<li class='dot'>...</li>";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                            else
                                $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                        }
                        $pagination.= "<li class='dot'>..</li>";
                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$lpm1}'>{$lpm1}</a></li>";
                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$lastpage}'>{$lastpage}</a></li>";
                    } else {

                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='1'>1</a></li>";
                        $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='2'>2</a></li>";
                        $pagination.= "<li class='dot'>..</li>";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination.= "<li><a class='current'>{$counter}</a></li>";
                            else
                                $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$counter}'>{$counter}</a></li>";
                        }
                    }
                }

                if ($page < $counter - 1) {
                    $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$next}'>{$nextlabel}</a></li>";
                    $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi' page='{$lastpage}'>{$lastlabel}</a></li>";
                }

                $pagination.= "</ul>";
            }

            return $pagination;
        }


        function _video_convert($url=''){
              if($url!=''){
                  //echo $url;exit;
                  $parts=parse_url($url);
                  $fp = fsockopen($parts['host'],isset($parts['port'])?$parts['port']:80,$errno, $errstr, 30);
                  $out = "GET ".$parts['path']." HTTP/1.1\r\n";
                  $out.= "Host: ".$parts['host']."\r\n";
                  $out.= "Content-Length: 0"."\r\n";
                  $out.= "Connection: Close\r\n\r\n";

                  fwrite($fp, $out);
                  fclose($fp);
              }
              else{
                  return;
              }
        }

        function valid_phone($str='') {
            return (!preg_match("/^[0]?[56789]\d{9}$/", $str)) ? FALSE : TRUE;
        }

        function valid_email($str='') {

            if((preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $str))){
                return true;
            }
            else{
                return false;
            }
        }

        function type_email_or_phone($string=''){
            if($this->valid_email($string)){
                return 1; //email
            }
            else if($this->valid_phone($string)){
                return 2; //phone
            }
            else{
                return 0;
            }
        }
        
        /*
            @Function get post value
        */
        public function _post($field='',$request_data){
            $posts = $request_data;
            $field = trim($field);
            if(!is_array($field)){
                if($field != ''){
                    if(array_key_exists($field,$posts)){
                        if(is_array($posts[$field])){
                            return $posts[$field];
                        }
                        else{
                            return trim($posts[$field]);
                        }
                    }
                    else{
                        return '';
                    }
                }
                else{
                    return '';
                }
            }
            else{
                return '';
            }
        }
    }
}
?>
