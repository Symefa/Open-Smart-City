<?php

/**
*	Copyright Smalarobotics 2015
*	Cybernature Project
*	Alifa Izzan
*/
	
class Point
{
	//variable	
	public $id;
	public $name;
	public $latitude;
	public $longitude;
	public $keluhan;
	
	//main construct
	public function __construct($Id,$Name, $Latitude, $Longitude, $Keluhan)
	{
		$this->id= $Id;
		$this->name = $Name;
		$this->keluhan = $Keluhan;
		$this->latitude = $Latitude;
		$this->longitude = $Longitude;
	}
	
	public function toArray()
	{
		return array('id'=>$this->id,'name' => $this->name, 'lat' => $this->latitude, 'lng' => $this->longitude, 'keluhan' => $this->keluhan);
	}

}