<?php

class Juego extends MY_CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BatallaNaval_model','bnmodel');
	}
	public function atacar($strpos)
	{
		$pos=explode('-',$strpos);
		$result['estado']=$this->bnmodel->atacar($pos[1]);
		print json_encode($result);
	}
	public function estado($strplayer)
	{
		$pos=explode('-',$strplayer);
		$result['estado']=$this->bnmodel->estadoJuego($pos[1]);
		print json_encode($result);
	}
	public function machine()
	{
		$pos=$this->bnmodel->machinePlay();
		print json_encode($pos);
	}
}
