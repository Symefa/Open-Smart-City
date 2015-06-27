<?php

/**
 *	Open Smart City Project.
 */
require_once 'Point.php';

class Points extends Point
{
    private $myArray = array();
    private $point;
    private $category;

    protected $conf;
    protected $dbJob;

    public function __construct($category)
    {
        $this->category = $category;
        $this->conf = require __DIR__.'/../conf/config.php';
        $this->dbJob = new PDO(
        "mysql:host={$this->conf['dbHost']};dbname={$this->conf['dbName']}",
            $this->conf['dbUser'],
            $this->conf['dbPass']
        );
        $this->refresh();
    }

    public function getApi()
    {
        return $this->conf['ApiKey'];
    }

    public function getTitle()
    {
        return $this->conf['Title'];
    }

    public function addPoint($point)
    {
        $stmt = $this->dbJob->prepare('INSERT INTO Locations (Name,Latitude,Longitude,Keluhan, urlFoto) VALUES (:name,:latitude,:longitude,:keluhan :urlFoto)');
        $stmt->bindParam(':name', $point->name);
        $stmt->bindParam(':latitude', $point->latitude);
        $stmt->bindParam(':longitude', $point->longitude);
        $stmt->bindParam(':keluhan', $point->keluhan);
        $stmt->bidParam(':urlFoto', $point->urlFoto);
        $stmt->execute();
        $this->refresh();
    }

    public function getPoints()
    {
        return ['Locations' => $this->myArray];
    }
    public function refresh()
    {
        $this->myArray = array();
        $stmt = $this->dbJob->prepare('SELECT * FROM Locations');
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $foto = null;
            if (isset($row['urlFoto'])) {
                $foto = $row['urlFoto'];
            }
            $this->point = new Point($row['ID'], $row['Name'], $row['Latitude'], $row['Longitude'], $row['Keluhan'], $foto);
            array_push($this->myArray, $this->point->toArray());
        }
    }
}
