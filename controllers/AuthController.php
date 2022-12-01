<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isPost()) {
            //TODO: recive it from the form
            $user = new User();
            $user->email = 'rana@test.com';
            $user->password = '123';;
            if ($user->login()) {
                var_dump("fffffffffffffff");
                return ;
            }
        }

        return $this->render('login');
    }
}