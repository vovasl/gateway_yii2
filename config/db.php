<?php

$host = env('MYSQL_HOST');
$port = env('MYSQL_PORT');
$dbName = env('MYSQL_DATABASE');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$host};port={$port};dbname={$dbName}",
    'username' => env('MYSQL_USERNAME'),
    'password' => env('MYSQL_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
