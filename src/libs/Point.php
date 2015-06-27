<?php

/**
 *	Open Smart City Project.
 */
class Point
{
    //variable
    public $id;
    public $name;
    public $latitude;
    public $longitude;
    public $keluhan;
    public $urlFoto;

    //main construct
    public function __construct($Id, $Name, $Latitude, $Longitude, $Keluhan, $UrlFoto)
    {
        $this->id = $Id;
        $this->name = $Name;
        $this->keluhan = $Keluhan;
        $this->latitude = $Latitude;
        $this->longitude = $Longitude;
        $this->urlFoto = $UrlFoto;
    }

    public function toArray()
    {
        return array('id' => $this->id,'name' => $this->name, 'lat' => $this->latitude, 'lng' => $this->longitude, 'keluhan' => $this->keluhan, 'urlFoto' => $this->urlFoto);
    }
}
