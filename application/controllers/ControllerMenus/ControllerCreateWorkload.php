<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ControllerCreateWorkload extends MY_Controller
{
	public function index()
	{
		$view = 'module/view_workload';
		$throw = $data_division;
		$this->Templating($view);
	}
}
