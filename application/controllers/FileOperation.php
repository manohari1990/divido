<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class FileOperation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		// Load the todo model to make it available 
		// to *all* of the controller's actions 
		$this->load->model('Welcome_model');
	}

	/*
	* To get all files from directory and return unique key-value pair response from valid json (which is later).
	*/
	public function index()
	{															
		$appPath = realpath(FCPATH) . "/fixtures";				// to get absolute path name
		$tempArray = [];
		$ResultArray = [];
		$errorFiles = [];
		$files = scandir($appPath);								// scan all files from the directory.
		$files = array_diff(scandir($appPath), array('.', '..'));
		foreach($files as $file){
			$file_content = file_get_contents($appPath . '/'. $file, true) or die("FAIL");			// get file content from path
			
			$ext = pathinfo(basename($file), PATHINFO_EXTENSION);
			if($ext != 'json'){																		// To handle different file types  
				if($ext == 'csv'){																	// check if File is in csv format
					$file_content = $this->Welcome_model->convertCSVToJSON($appPath . '/'. $file);	// calling a function which extract json string from csv file
					if($file_content == ''){
						array_push($errorFiles, basename($file));									// if file is not valid content adding it into error file list.
					}
				}
			}
			
			$isValid = $this->Welcome_model->isValidJson($file_content);							// Passing parameters to check generated json is valid or not
			if($isValid){
				$tempArray = $this->Welcome_model->ObjectToArray(json_decode($file_content,true));	// if valid - Convert all json object  to array.
				$ResultArray = array_unique(array_merge($ResultArray, $tempArray), SORT_REGULAR);	// merging all array and filtering it with unique key-value pair.
			}else{
				array_push($errorFiles, basename($file));											// if Invalid json - move the file into error list files.
			}
		}
		$data['ResultArray'] = json_encode($ResultArray);
		$data['errorFiles'] = json_encode($errorFiles);
		$this->load->view('method1', $data);														// pass all result arrays to view.
	}


	/*
	* Using ajax request loading files and filter values or sections using javascript
	*/
	public function method2()
	{
		$this->load->view('method2');
	}


	/*
	* Trigger this method when ajax call initialize and returns json string from only JSON files.  
	*/
	public function getFileContent(){
		$appPath = realpath(FCPATH) . "/fixtures";
		$tempArray = [];
		$ResultArray = [];
		$errorFiles = [];
		foreach(glob($appPath . '/*.json') as $file) {
			$file_content = file_get_contents($file, true) or die("FAIL");
			$isValid = $this->Welcome_model->isValidJson($file_content);
			if($isValid){
				array_push($ResultArray, json_decode($file_content));
			}else{
				$name = basename($file);
				array_push($errorFiles, $name);
			}
		}
		$data['ResultArray'] = $ResultArray;
		$data['errorFiles'] = $errorFiles;
		echo json_encode($data);
	}
	
	/*
	* Handles only JSON files
	*/
	public function OnlyJsonFile()
	{
		$appPath = realpath(FCPATH) . "/fixtures";
		$tempArray = [];
		$ResultArray = [];
		$errorFiles = [];
		foreach(glob($appPath . '/*.json') as $file) {
			$file_content = file_get_contents($file, true) or die("FAIL");

			//check is valid json or not
			$isValid = $this->Welcome_model->isValidJson($file_content);
			if($isValid){
				$tempArray = $this->Welcome_model->ObjectToArray(json_decode($file_content,true));
				$ResultArray = array_unique(array_merge($ResultArray, $tempArray), SORT_REGULAR);
			}else{

				$name = basename($file);
				array_push($errorFiles, $name);
			}
		}
		$data['ResultArray'] = json_encode($ResultArray);
		$data['errorFiles'] = json_encode($errorFiles);
		$this->load->view('method1', $data);
	}
	
}