<?php

namespace Locations;
use Core\AbstractRepository;
use PDO;

class LocationsRepository extends AbstractRepository {

    public function getModel()
    {
        return "Locations\\LocationModel";
    }

    public function getTable()
    {
        return "location";
    }

    public function getIdName()
    {
        return "location_ID";
    }

}