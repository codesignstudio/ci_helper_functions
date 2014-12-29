<?php
namespace Kharota;
    class Assets{

        public static $reg_js = array();
        public static $reg_css = array();
        public static $asset_folder = "assets";
        public static $sep = "/";
        public static$js_folder = "js";
        public static $css_folder = "css";
        public static $images_folder = "images";


        static function url($text){
            return base_url(). $text;
        }

        static function addjs($filename){

            $result = false;
            if(!in_array($filename, SELF::$reg_js)):
            $result =  array_push(SELF::$reg_js, $filename);
                endif;


            return $result;

        }

        /**
         * @param $array
         */
        static function addjs_multi($array){

            $chunk = explode(",", $array);
            foreach($chunk as $rows):
                $rows = trim($rows);
                SELF::addjs($rows);
                endforeach;
        }


        /**
         * @param $filename
         * @return int
         */

       static function addcss($filename){

            $result = false;
            if(!in_array($filename, SELF::$reg_css)):
              $result =  array_push(SELF::$reg_css, $filename);
            endif;

            return $result;
        }


        /**
         * @return array
         */
        static function renderjs(){


            foreach(SELF::$reg_js as $rows):
              echo "<script type=\"text/javascript\" src=\"".
                  SELF::url(SELF::$asset_folder . SELF::$sep . SELF::$js_folder . SELF::$sep . $rows) .
                  "\"></script>
                  ";
                endforeach;
        }


        static function js_cdn($url){

            echo "<script type=\"text/javascript\" src=\"".
                $url .
                "\"></script>
                  ";
        }


        static function css_cdn($url){

            echo "<link href=\"$url\" rel=\"stylesheet\" type=\"text/css\" />";
        }


        /**
         * @return array
         */
       static  function rendercss(){

            foreach(SELF::$reg_css as $rows):
                echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"".
                    SELF::url(SELF::$asset_folder . SELF::$sep . SELF::$css_folder . SELF::$sep . $rows) .
                    "\" />
                  ";
            endforeach;
        }

        /**
         * @param $url
         * @return string
         */


        static function img_url($url){

            return SELF::url(SELF::$asset_folder . SELF::$sep . SELF::$images_folder . SELF::$sep . $url);

        }


        /**
         * @param $url
         * @return string
         */

        static function js_url($url){

            return SELF::url(SELF::$asset_folder . SELF::$sep . SELF::$js_folder . SELF::$sep . $url);

        }

        /**
         * @param $url
         * @return string
         */

        static function css_url($url){

            return SELF::url(SELF::$asset_folder . SELF::$sep . SELF::$css_folder . SELF::$sep . $url);

        }

        /**
         * @param $array
         * @usage    $ass->img("test.jpg", array("width" => "200px", "height" => "100px", "alt" => "alt here", "class" => "lazy"));
         */
        static function img($filename, $array){

            $width = $array["width"];
            $height = $array["height"];
            $alt = $array["alt"];
            $css_classes = $array["class"];

            if($width){
                $mywidth = "width=\"$width\"";
            }

            if($height){
                $myheight = "width=\"$height\"";
            }

            if($alt){
            $myalt = "alt=\"$alt\"";
        }

            if($css_classes){
            $my_classes = "class=\"$css_classes\"";
        }
          echo  "<img src=\"".
            SELF::url(SELF::$asset_folder . SELF::$sep . SELF::$images_folder . SELF::$sep . $filename).
            "\" $myalt  $myheight $mywidth $my_classes  />";


        }



       }




    Class Load{


       static function view($view, $data = null){
           $obj =& get_instance();
           return $obj->load->view($view, $data);
       }


        static function model($model){
            $obj =& get_instance();
            return $obj->load->model($model);
        }


        static function library($lib, $config = null, $obj_name = null){
            $obj =& get_instance();
            return $obj->load->library($lib, $config, $obj_name);
        }


        static function helper($helper){
            $obj =& get_instance();
            return $obj->load->helper($helper);
        }



    }

    Class Input{


        static function post($data, $bol = null){

            $obj =& get_instance();
            return $obj->input->post($data, $bol);
        }



        static function get($data, $bol = null){

            $obj =& get_instance();
            return $obj->input->get($data, $bol);
        }


        static function ip_address(){

            $obj =& get_instance();
            return $obj->input->ip_address();
        }



        static function user_agent(){

            $obj =& get_instance();
            return $obj->input->user_agent();
        }


        static function is_ajax_request(){

            $obj =& get_instance();
            return $obj->input->is_ajax_request();
        }


        static function is_cli_request(){

            $obj =& get_instance();
            return $obj->input->is_cli_request();
        }






    }


    Class URI{

        static  function segment($n){
            $obj =& get_instance();
            return $obj->uri->segment($n);
        }


        static function base(){

            if(!function_exists(base_url())){

                $obj =& get_instance();
              return   $obj->config->base_url;

            }else{

                return base_url();
            }

        }


        static function current_url(){

            $Get_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URl'];
            return  $Get_url;
        }


    }



    Class Pagination{

        static function init($config){
            $obj =& get_instance();
            return $obj->pagination->initialize($config);
        }


        static function links(){
            $obj =& get_instance();
            return $obj->pagination->create_links();

        }
    }




   Class Config{

       static function item($n){
           $obj =& get_instance();
           return $obj->config->item($n);
       }


   }


    Class Encrypt{

        static function encode($s){

            $obj =& get_instance();
            $obj->load->library('encrypt');
            return $obj->encrypt->encode($s);
        }


        static function decode($s){

            $obj =& get_instance();
            $obj->load->library('encrypt');
            return $obj->encrypt->decode($s);
        }


    }


    Class DB{

        static function add($table_name, $data){

            $obj =& get_instance();
           return  $obj->db->insert($table_name, $data);
        }


        static function remove($table_name, $array_id){
            $obj =& get_instance();
            return  $obj->db->delete($table_name, $array_id);
        }


        static function update($table_name, $array_data, $where_id){
            $obj =& get_instance();
            $obj->db->where('id', $where_id);
            return $obj->db->update($table_name, $array_data);
        }


        static function query($query){
            $obj=& get_instance();
           return  $obj->db->query($query);
        }
    }



    Class Str{


        static function strip_tags($html){

            return strip_tags($html);
        }


        /**
         * @param $str
         * @param $what_to_find
         * @return bool
         */

        static function inStr($str, $what_to_find){

            if(strpos($str, $what_to_find) === false){
                return false;
            }else{

                return true;
            }

        }



        static function toLower($str){

            return strtolower($str);
        }


        static function toUpper($str){

            return strtoupper($str);
        }


        static function len($str){

            return strlen($str);
        }


        static function substr($str,  $start_str, $end_str = null){

           return  substr($str, $start_str, $end_str);
        }


        static function replace($str, $find, $replace_with){

            return str_replace($find, $replace_with, $str);
        }


        static function totalWords($str){

            return str_word_count($str);
        }

        /**
         * @param $str
         * @param $what_to_explode
         * @return array
         */
        static function explode($str, $what_to_explode){

            return explode($what_to_explode, $str);
        }

       static  function UnderlineAdd($txt){
            return str_replace(" ", "_", $txt);
        }


        static function DashAdd($txt){
            $strDash = str_replace(" ", "-", $txt);
            return $strDash;
        }

        static function DashRemove($txt){
            $strDash = str_replace(",", "-", $txt);
            $strDash = $strDash & str_replace("-", " ", $txt);
            return $strDash;
        }

       static  function UnderlineRemove($txt){
            return str_replace("_", " ", $txt);
        }


    }

    Class Validate{

        static function isUrl($url){

            return filter_var($url, FILTER_VALIDATE_URL);
        }


        static function isEmail($email){

            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        static function isIP($v){

            return filter_var($v, FILTER_VALIDATE_IP);
        }

        static function isInt($int){
            return filter_var($int, FILTER_VALIDATE_INT);
        }

        static function isDate($date){
            if(strtotime($date) == false){
                return false;
            }else{
                return true;
            }

        }

        static function isString($text){

            return is_string($text);
        }

        static function isArray($array){

            return is_array($array);
        }

        static function isJson($string) {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }

        static function isHTML($text){
            $processed = htmlentities($text);
            if($processed == $text) return false;
            return true;
        }




        static function get_clean_TEXT_from_input($data){

            return filter_var($data, FILTER_SANITIZE_STRING);
        }

        static function get_clean_EMAIL_from_input($data){
            //this filter removes junks/tags and gets only email.
            return filter_var($data, FILTER_SANITIZE_EMAIL);
        }


        static function get_clean_URL_from_input($data){
            //this filter removes junks/tags and gets only email.
            return filter_var($data, FILTER_SANITIZE_URL);
        }

        static function get_clean_INT_from_input($data){
            //this filter removes junks/tags and gets only email.
            return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        }





    }

    Class CURL{

        static function get_as_String($url){

           return  file_get_contents($url);
        }


        static function get_as_Array($url){

            return file($url);
        }


        static function is_ajax() {
            return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
        }



    }


    Class Files{

       static function convert_filesize($filesize){

            if(is_numeric($filesize)){
                $decr = 1024; $step = 0;
                $prefix = array('Byte','KB','MB','GB','TB','PB');

                while(($filesize / $decr) > 0.9){
                    $filesize = $filesize / $decr;
                    $step++;
                }
                return round($filesize,2).' '.$prefix[$step];
            } else {

                return 'NaN';
            }

        }


        static function exits($path){

            return file_exists($path);
        }

        static function delete_file($path){

            return unlink($path);
        }

        static function copy_file($file, $new_file_name){

            return copy($file, $new_file_name);
        }

        static function is_writeAble($dir_or_file){

            return is_writable($dir_or_file);
        }

        static function create_folder($path, $perm = 0755){

           return mkdir($path, $perm);
        }

        static function change_permission($path, $perm = 0755){

            return chmod($path, $perm);
        }

        static function get_contents_as_string($path){

            return file_get_contents($path);
        }

        static function get_contents_as_array($path){

            return file($path);
        }

        static function get_file_extension($path){

            return pathinfo($path, PATHINFO_EXTENSION);
        }


        static function get_filename($path){

            return pathinfo($path, PATHINFO_FILENAME);
        }

        /**
         * @param $path
         * @return int
         */
        static function get_file_size($path){

            return filesize($path);
        }





    }


    Class Arrays{

        static function len($array){

            return count($array);
        }

        static function exists_in_array($array, $findme){

            return in_array($findme, $array);
        }

        static function get_last_child($array){

            return end($array);
        }

        static function get_first_child($array){

            return current($array);
        }

        static function search($array, $findme){

            return array_search($findme, $array);
        }

        static function append($array, $new_item){
            return array_push($array, $new_item);
        }

        static function subArray($array, $offset, $len = null){
            //works like substr
            return array_slice($array, $offset, $len);
        }

        static function joinArray($array1, $array2){
            return array_merge($array1, $array2);
        }

        static function remove_duplicate_in_array($array){
            //removes all duplicate entries in array
            return array_unique($array);
        }

        static function remove_element_of_array($array, $item_to_be_removed){
            $key = array_search($item_to_be_removed, $array);
            if($key!==false){
               unset($array[$key]);
            }
        }


        static function remove_first_element($array){
            return array_shift($array);
        }


    }

    Class Hash{

        static function create_random_salt(){

            return  bin2hex(openssl_random_pseudo_bytes(22));
        }



        static function hash_password($password, $salt){

            if(Common::php_version() >= 5.5){

                             return password_hash($password, PASSWORD_DEFAULT);

            }else{
           return  md5($password.$salt);
            }

        }


        static function verify_password($hash, $password){

            return  password_verify($password, $hash);

        }



    }


    Class Common{

        static function php_version(){

            return phpversion();
        }
    }
?>