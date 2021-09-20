<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Welcome_model');
	}
	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$appPath = realpath(FCPATH) . "/configurations";
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


	public function method2()
	{
		$appPath = realpath(FCPATH) . "/configurations";
		$tempArray = [];
		$ResultArray = [];
		$errorFiles = [];
		foreach(glob($appPath . '/*.json') as $file) {
			$file_content = file_get_contents($file, true) or die("FAIL");

			//check is valid json or not
			$isValid = $this->Welcome_model->isValidJson($file_content);
			if($isValid){
				$ResultArray = array_merge($ResultArray, $tempArray);
				// $tempArray = $this->Welcome_model->ObjectToArray(json_decode($file_content,true));
				// $ResultArray = array_unique(array_merge($ResultArray, $tempArray), SORT_REGULAR);
			}else{
				$name = basename($file);
				array_push($errorFiles, $name);
			}
		}
		echo "<pre>" + json_decode($ResultArray) + "</pre>";
		// $data['ResultArray'] = json_encode($ResultArray);
		// $data['errorFiles'] = json_encode($errorFiles);
		$this->load->view('method2');
	}
}
