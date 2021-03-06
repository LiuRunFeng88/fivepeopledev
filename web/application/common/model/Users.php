<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 11:05
 */
/**
 * Created by 刘先生
 * 2018/11/7 11:05
 */

namespace app\common\model;


use think\Model;

class Users extends Model {

    protected $table = 'users';

    public static $err_code;

    public static function account_login($mobile,$password){
        $users = self::where(['mobile'=>$mobile,'password'=>md5($password)])->find();
        if (empty($users)){
            throw new \Exception(ErrorCode::formatErrorMsg(ErrorCode::ERROR_FAIL_LOGIN),ErrorCode::ERROR_FAIL_LOGIN);
        }elseif ($users->enabled == 2){
            throw new \Exception(ErrorCode::formatErrorMsg(ErrorCode::ERROR_USER_CLOSURE),ErrorCode::ERROR_USER_CLOSURE);
        }
        return $users;
    }

    //手机号是否注册
    public static function is_register($mobile){
        $num = self::where(['mobile'=>$mobile])->count('id');
        return $num;
    }

    //根据手机获取用户
    public static function find_user_by_mobile($mobile){
        $users = self::where(['mobile'=>$mobile])->find();
        return $users;
    }

}