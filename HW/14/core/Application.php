<?php
/**
 * User: TheCodeholic
 * Date: 7/7/2020
 * Time: 9:57 AM
 */

namespace core;

use core\View;
use core\Router;
use core\Request;
use core\Session;
use core\Response;
use core\UserModel;
use core\db\Database;

/**
 * Class Application
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app
 */
class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static Application $app;
    public static string $ROOT_DIR;
    public string $userClass;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public Cookie $cookie;
    public View $view;
    public ?UserModel $user;

    public function __construct($rootDir, $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        // self::$ROOT_DIR = $rootDir;
        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->session = new Session();
        $this->cookie = new Cookie();
        $this->view = new View();

        $key = $this->userClass::primaryKey();
        $userId = Application::$app->session->get($key);
        if ($userId) {
            $this->user = $this->userClass::findOne([$key => $userId]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $className = get_class($user);
        $primaryKey = $className::primaryKey();
        $value = $user->{$primaryKey};
        Application::$app->session->set('user', $value);

        return true;
    }

    public function logout()
    {
        $this->user = null;// we alway check users for knowing this user is entired or not
        $key = $this->userClass::primaryKey();
        self::$app->session->remove($key);
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->router->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }
}