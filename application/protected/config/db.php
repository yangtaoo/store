<?php
/**
 * MYSQL配置
 */
return array(
    'params' => array (
        'mysql_sharding_count' => 32,
    ),
    'components' => array (
         'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=coco',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '111111',
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging' => true,
        ),
    ),
);