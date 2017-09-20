<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/15/2017
 * Time: 9:06 AM
 */

namespace PhalconRest\Controllers;
use \PhalconRest\Exceptions\HTTPException;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Http\Request;
use PhalconRest\Models\Employee;

class EmployeeController extends RESTController{

    public function getModel(){
        $connection = $this->getConnection();

        $model = new Employee();
        $model->setDbAdapter($connection);

        return $model;
    }

    public function getConnection(){
        $connection = $this->dbadpt;

        return $connection;
    }

    public function get(){
        $model = $this->getModel();

        $data = $model->getAllData();
        $results = $data->fetchAll();

        return $this->respond($results);
    }

    public function getOne($id){
        $model = $this->getModel();
        $model->setId($id);

        $data = $model->getSpecificData();
        $results = $data->fetchAll();

        return $this->respond($results);
    }

    public function post(){
        $model = $this->getModel();

        $request = new Request();
        $first_name = $request->getPost('first_name');
        $last_name = $request->getPost('last_name');
        $email = $request->getPost('email');
        $gender = $request->getPost('gender');
        $phone_number = $request->getPost('phone_number');

        $dataPost = array(
            $first_name, $last_name, $email, $gender, $phone_number
        );

        $model->setDataInsert($dataPost);

        $success = $model->postData();

        if ($success){
            return array('status'=>'OK', 'message'=>'Success Inserting New Data');
        } else {
            return array('status'=>'FAIL', 'message'=>'Fail to Insert New Data');
        }
    }

    public function delete($id){
        $model = $this->getModel();

        $model->setId($id);

        $success = $model->deleteData();

        if ($success){
            return array('status'=>'OK', 'message'=>'Success Deleting Data');
        } else {
            return array('status'=>'FAIL', 'message'=>'Fail to Delete Data');
        }
    }

    public function put($id){
        $model = $this->getModel();

        $request = new Request();
        $first_name = $request->getPut('first_name');
        $last_name = $request->getPut('last_name');
        $email = $request->getPut('email');
        $gender = $request->getPut('gender');
        $phone_number = $request->getPut('phone_number');

        $dataUpdate = array(
            $first_name, $last_name, $email, $gender, $phone_number
        );

        $model->setId($id);
        $model->setDataUpdate($dataUpdate);

        $success = $model->updateData();

        if ($success){
            return array('status'=>'OK', 'message'=>'Success Updating New Data');
        } else {
            return array('status'=>'FAIL', 'message'=>'Fail to Update New Data');
        }
    }

}