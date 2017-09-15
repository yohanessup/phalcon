<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/15/2017
 * Time: 9:06 AM
 */

namespace PhalconRest\Models;

use \Phalcon\Mvc\Model;

class Employee extends Model
{
    var $id;
    var $dataInsert;
    var $dataUpdate;
    var $dbAdapter;

    var $tableColumnName = array(
        "first_name", "last_name", "email", "gender", "phone_number"
    );

    const tableName = "Employees";

    public function setId($emp_id)
    {
        $this->id = $emp_id;
    }

    public function setDataInsert($data_insert)
    {
        $this->dataInsert = $data_insert;
    }

    public function setDataUpdate($data_update)
    {
        $this->dataUpdate = $data_update;
    }

    public function setDbAdapter($adapter)
    {
        $this->dbAdapter = $adapter;
    }

    public function getAllData()
    {
        $connection = $this->dbAdapter;
        $data = $connection->query("SELECT * FROM employees");

        return $data;
    }

    public function getSpecificData()
    {
        $connection = $this->dbAdapter;
        $data = $connection->query("SELECT * FROM employees WHERE id=?",
            [
                $this->id
            ]);

        return $data;
    }

    public function postData()
    {
        $connection = $this->dbAdapter;

        $success = $connection->insert(
            $this::tableName,
            $this->dataInsert,
            $this->tableColumnName
        );

        return $success;
    }

    public function updateData()
    {
        $connection = $this->dbAdapter;

        $success = $connection->update(
            $this::tableName,
            $this->tableColumnName,
            $this->dataUpdate,
            [
                "conditions" => "id = ?",
                "bind"       => [$this->id],
            ]
        );

        return $success;
    }

    public function deleteData()
    {
        $connection = $this->dbAdapter;

        $success = $connection->delete(
            $this::tableName,
            "id = ?",
            [$this->id]
        );

        return $success;
    }
}