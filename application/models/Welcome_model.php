<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome_model extends CI_Model  {
    
    private $jsonFormater;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /* 
    * Converting a JSON object to array to help it in appending values
    * returns an Array 
    */
    function ObjectToArray($obj)
    {
        $array = array();
        foreach ($obj as $key => $value)
        {
            if (is_object($value)) {
                $array[$key] = $this->ObjectToArray($value);
            }
            if (is_array($value)) {
                $array[$key] = $this->ObjectToArray($value);
            }
            else{
                $array[$key] = $value;
            }
        }
        return $array;
    }

    /* 
    * Check if JSON string is valid or not 
    * return true/false
    */
    function isValidJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }


    /* 
    * To convert column as parent/sub node and assign value to least child 
    * eg: column is "database__host" and value is "mysql"
    * the result will be:
    * {database:{ host: mysql }}
    */
    function convertCSVToJSON($filePath){               // to convert CSV records to JSON string 

        $csv = file_get_contents($filePath);
        
        $content = array_map("str_getcsv", explode("\n", trim($csv)));      // to get file content into a string format
        $headers = $content[0];
        array_shift($content);

        $json = [];
        $obj = [];
        
        foreach ($content as $key => $value) {
            foreach($headers as $k => $v){
                $headerV = str_replace('"', '', $v);
                $obj = $this->recursiveMethod($headerV, $obj, $value[$k]);      // method which iterates everytime until it reaches to last child.
            }
        }
        if($obj == null){
            return "";    
        }
		return str_replace("\ufeff","",json_encode($obj));
        
    }


    function recursiveMethod($str, $parentObj, $data){
        if(sizeof(explode('__', $str)) === 1){
            $parentObj[$str] = $data;
            return $parentObj;
        }

        $t = explode('__', $str);
        $curKey = $t[0];
        
        if(!isset($parentObj[$curKey]))
            $parentObj[$curKey] = [];
        
        array_shift($t);
        $parentObj[$curKey] = $this->recursiveMethod(implode('__',$t), $parentObj[$curKey], $data);

        return $parentObj;
    }

}
?>