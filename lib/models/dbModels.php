<?php

namespace hwhome\lib\models;

// 디비 테이블명, 데이터베이스서 불러오는 crud문 분리해서 여기서 쓰기

/*
* database 연결 - dbpdo::db()
* @parameter use 역할 -> model에서 입력.
*/
//$db = dbpdo::db('board');

//$databse, $table 상속 받아서 쓰기

use home\ubuntu\config\dbpdo as dbpdo;

class dbModels
{

    public function pdo()
    {
        return dbpdo::db('board');
    }
}