<?php

namespace InstaRouter\Database;

use InstaRouter\Database\Worker;

class Blueprint
{
    public $table;
    public $materials = array();
    public $plan;

    public function collect($material)
    {
        array_push($this->materials, $material);
        return $this->materials;
    }

    public function build()
    {
        $schema = "";
        foreach($this->materials as $index => $material)
        {
            if($index < count($this->materials) - 1)
            {
                $schema .= $material['name'] . ' ' . $material['type'] . ' ' . (empty($material['options']) ? '' : $material['options']) . ', ';
            } else {
                $schema .= $material['name'] . ' ' . $material['type'] . ' ' . (empty($material['options']) ? '' : $material['options']);
            }
        }
        $this->plan = "CREATE TABLE " . $this->table . " (" . $schema . ")";
        echo $this->plan;
        return $this->migrate($this->plan);
    }

    public function migrate($sql)
    {
        $worker = new Worker();
        $conn = $worker->connect();

        if ($conn->query($sql) !== true) {
            echo $conn->error;
        } else {
            return true;
        }
    }

    public function drop()
    {
        $sql = "DROP TABLE IF EXISTS " . $this->table;
        $this->migrate($sql);
    }
}
