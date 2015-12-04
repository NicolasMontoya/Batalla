<?php

class Inicio extends MY_CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BatallaNaval_model','bnmodel');
	}

	public function index()
	{
		$this->bnmodel->iniciarJuego();
		$data['content']=$this->load->view('inicio.phtml','',TRUE);
		$this->load->view($this->layout,$data);
	}

	public function guardarPosicion($strpos)
	{
		$pos=explode('-',$strpos);
		$result['estado']=$this->bnmodel->guardarPosicion($pos[1]);
		print json_encode($result);
	}
	public function  borrarPosicion($strpos)
	{
		$pos=explode('-',$strpos);
		$result['estado']=$this->bnmodel->borrarPosicion($pos[1]);
		print json_encode($result);
	}
}
