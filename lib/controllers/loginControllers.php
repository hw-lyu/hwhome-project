<?php

namespace hwhome\lib\controllers;

/* use */
use hwhome\lib\models\dbModels as dbModels;
use home\ubuntu\config\commondb as db;

class loginControllers extends dbModels
{
    public static $loginArr;

    public function home()
    {
        //로그인
        $pdo = parent::pdo();

        if(sizeof($_SESSION['memberIdx'])) {
            $login = $pdo->prepare(db::read('hwhome_member', 'member_idx, member_id, member_level'));
            $login->execute();

            $loginTableArr = $login->fetchAll($pdo::FETCH_ASSOC);

            for($i=0,$len=count($loginTableArr); $i<$len; $i++) {
                foreach($loginTableArr[$i] as $key => $val) {
                    if($key === 'member_idx' && $_SESSION['memberIdx'] === $val) {
                        loginControllers::$loginArr = [
                            'member_idx' => $loginTableArr[$i]['member_idx'],
                            'member_id' => $loginTableArr[$i]['member_id'],
                            'member_level' => $loginTableArr[$i]['member_level']
                        ];
                    }
                }
            }
        }

    }
}

