<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/19/2017
 * Time: 5:59 PM
 */

namespace PhalconRest\Controllers;

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Http\Request;
use PhalconRest\Models\Employee;


class PublicController extends RESTController {

    public function getModel()
    {
        //use the default db adapter that has been set in the default injector
        $connection = $this->dbadpt;

        //use 'Employee' model and set the default db adapter connection
        $model = new Employee();
        $model->setDbAdapter($connection);

        return $model;
    }
    public function employeesAction()
    {
        $model = $this->getModel();

        $data = $model->getAllData();
        $results = $data->fetchAll();

        //send data result to view
        $this->view->data = $results;

        //render the employee-data view
        echo $this->view->render('employee-data');
    }
}