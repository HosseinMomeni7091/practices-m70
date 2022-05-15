<?php
/**
 * User: TheCodeholic
 * Date: 7/8/2020
 * Time: 8:43 AM
 */

namespace app\controllers;


use core\Request;
use core\Response;
use app\models\User;
use core\Controller;
use core\Application;
use app\models\LoginForm;
use core\middlewares\AuthMiddleware;

/**
 * Class SiteController
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function home()
    {
        // echo "home";
        return $this->render('home', [
            'name' => 'HosseinMomeni from site controller'
        ]);
    }
    public function manager()
    {
        $this->setLayout('manager');
        return $this->render('home', [
            'name' => "manager"
        ]);
    }
    public function userconfirmation()
    {
        $this->setLayout('manager');
        return $this->render('home', [
            'name' => "manager"
        ]);
    }
    public function departments()
    {
        $this->setLayout('manager');
        return $this->render('Departments', [
            'name' => "manager"
        ]);
    }

    public function login(Request $request)
    {

        echo '<pre>';
        var_dump($request->getBody(), $request->getRouteParam('id'));
        echo '</pre>';
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            //filter data and asignment to related property
            $loginForm->loadData($request->getBody());
            // validat input -- check requested email is existed or not? check password is coorect or not?
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody()); 
            // validation ---- first hash pass in user and then save in DbModel 
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/profile');//new request//change request
                return 'Show success page';
            }

        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }


    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function profile()
    {
        return $this->render('profile');
    }

    public function profileWithId(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
    }
}
