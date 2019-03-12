<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ControllerTest extends MY_Controller
{
	public function index()
	{
		// echo 'ate';
		$view = 'module/view_test';
		$this->Templating($view);
	}
}
