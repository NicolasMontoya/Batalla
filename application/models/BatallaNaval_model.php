<?php

class BatallaNaval_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function iniciarJuego()
	{
		$this->session->tbluser = array_fill(1,36,0);
		$this->session->tbluserattack = 0;
		$this->session->tblmachineattack = 0;
		$this->session->shotmachine = array_fill(1,36,0);
		$tblmachine=array_fill(1,36,0);
		$this->seleccionarPosiciones($tblmachine);
		$this->session->tblmachine=$tblmachine;
		$this->session->numpos=0;
	}

	public function estadoJuego($player)
	{
		$tblmachine = $this->session->tblmachineattack;
		$tbluser = $this->session->tbluserattack;
		if($player==0)
		{
			return $tbluser;
		}
		else
		{
			return $tblmachine;
		}

	}

	public function atacar($pos)
	{
		$tbluserattack = $this->session->tbluserattack;
		$tblmachine = $this->session->tblmachine;

		if($tblmachine[$pos] == 1)
		{
			$tbluserattack++;
			$rpta = true;
		}
		else
		{
			$rpta = false;
		}
		$this->session->tbluserattack=$tbluserattack;
		return $rpta;
	}

	public function guardarPosicion($pos)
	{
		$rpta=$this->session->numpos;
		if($this->session->numpos<6){
			$tbluser=$this->session->tbluser;
			if($tbluser[$pos]==0){
				$tbluser[$pos]=1;	
				$this->session->numpos++;
				$this->session->tbluser=$tbluser;
			}	
		}
		return $rpta;		
	}

	private function seleccionarPosiciones(&$tabla)
	{
		$i=0;
		while($i<6){
			$pos=mt_rand(1,36);
			if($tabla[$pos]==0){
				$i++;
				$tabla[$pos]=1;
			}
		}

	}
	public function borrarPosicion($pos)
	{
		$rpta=$this->session->numpos;
		if($this->session->numpos<6)
		{
			$tbluser=$this->session->tbluser;
			if($tbluser[$pos]==1){
				$tbluser[$pos]=0;
				$this->session->numpos--;
				$this->session->tbluser=$tbluser;
			}
		}
		return $rpta;
	}
	public function machinePlay()
	{
		$tbluser=$this->session->tbluser;
		$machine=$this->session->tblmachineattack;
		$pos=$this->aleatorio();
		if($tbluser[$pos] == 1)
		{
			$machine++;
			$rpta= array('place' => $pos, 'estado' => true);
		}
		else
		{
			$rpta=array('place' => $pos, 'estado' => false);
		}
		$this->session->tblmachineattack=$machine;
		return $rpta;



	}
	public function aleatorio()
	{
		$tblmachine = $this->session->shotmachine;
		$i=0;
		do
		{
			$pos=mt_rand(1,36);
			if($tblmachine[$pos]==0)
			{
				$tblmachine[$pos]=1;
				$i++;
			}
		}while($i<1);
		$this->session->shotmachine=$tblmachine;
		return $pos;
	}

}