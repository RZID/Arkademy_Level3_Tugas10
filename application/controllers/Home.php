<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("md_data");
	}
	public function index()
	{
		$md_data = $this->md_data;
		$data = ["md_data" => $md_data, "title" => "CRUD App | Arkademy"];
		$this->load->view("templating/ahead", $data);
		$this->load->view("index", $data);
		$this->load->view("templating/emodal", $data);
		$this->load->view("templating/fscript", $data);
		$this->load->view("templating/gscript", $data);
		$this->load->view("templating/zfoot", $data);
	}
}
