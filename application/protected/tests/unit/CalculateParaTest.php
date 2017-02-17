<?php
require_once('D:/projects/greenviro/application/greenviro_consts.php');
Yii::import('application.models.*');
Yii::import('application.modules.service.models.*');
Yii::import('application.modules.service.controllers.*');

class CalculateParaTest extends CTestCase{

    public function testCalculatePara(){
        //$controller=new SoapController('hello');
        //echo $controller->setParameterValue('205', '1', '205', '1.3', '1', '1410466500', '{"A1":55.1,"R1":-50.0}');//1410466500
        //$value= SoapModel::getInstance()->getParameterValueByDay(613,
        //                            time(),
        //                            5);
        SoapModel::getInstance()->generateParameterTable(21);
        //$value_array = array(
        //    'parameter_id'=>613,
        //    'collect_time'=>time(),
        //    'parameter_value'=>2,
        //);
        //SoapModel::getInstance()->insertParameterValue($value_array, 3);
        $value_array = array(
            'parameter_id'=>1972,
            'collect_time'=>time(),
            'parameter_value'=>20,
        );
        //SoapModel::getInstance()->insertParameterValue($value_array, 21);
        $value= SoapModel::getInstance()->getAvgParameterValueByDay(1972,
                                    time(),
                                    21);
        if($value!==null){
            var_dump($value);
            $value= SoapModel::getInstance()->updateParameterValueByDay(613,
            20,
            time(),
            3);
        }else{
            echo 'no data!';
        }
    }

    public function testTemperature()
    {
        //$controller=new SoapController('hello');
        //echo $controller->setParameterValue('205', '1', '205', '1.3', '1', '1410466500', '{"A1":55.1,"R1":-50.0}');//1410466500
    }
}
