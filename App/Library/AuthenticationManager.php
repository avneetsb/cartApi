<?php

/**
 * Class to handle all Authentication Management functionality
 */
namespace App\Library;

use App\Model\UserModel;

/**
 * Class to handle all Authentication Management functionality
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class AuthenticationManager
{
    /**
     * Private variable, used to store get Session Manager Object
     * @var Object
     */
    private $sessionManager;
    /**
     * Private variable, used to store DB Connection string
     * @var Array
     */
    private $userDB;
    /**
     * Private variable, used to store Cache Manager Object
     * @var Object
     */
    private $cacheManager;

    /**
     * Default constructor, used to initialize variables required for Authentication Object
     * @param Object $cacheManager Cache Manager Object
     * @param Object $sessionManager Session Manager Object
     * @param Array $databaseFactory DB Connection String mappings
     */
    public function __construct($cacheManager, $sessionManager, $databaseFactory)
    {
        $this->cacheManager   = $cacheManager;
        $this->sessionManager = $sessionManager;
        $this->userDB         = $databaseFactory->getUserMap();
    }

    /**
     * Function to actually authenticate user
     * @param String $username Username of user
     * @param String $password Password of user
     */
    public function authenticate($username, $password)
    {
        if (!$this->isUserLoggedIn()) {
            return $this->doLogin($username, $password);
        }
        return array('status' => true, 'message' => 'Already LoggedIn');
    }

    /**
     * Function to process Login & set session
     * @param String $username Username of user
     * @param String $password Password of user
     */
    public function doLogin($username, $password)
    {
        $status  = false;
        $message = null;

        $user = $this->getUserByCredentials($username, $password);
        if ($user instanceof UserModel) {
            $this->setUserSession($user);
            $status  = true;
            $message = 'Logged In Successfully';
        } else {
            $message = 'Invalid Credentials';
        }
        return array('status' => $status, 'message' => $message);
    }

    /**
     * Function to set session details
     * @param Object $user User Model Object
     */
    private function setUserSession($user)
    {
        $this->sessionManager->set('_user', $user->getUserId());
    }

    /**
     * Function to fetch user details using credentials
     * @param String $username Username of user
     * @param String $password Password of user
     */
    private function getUserByCredentials($username, $password)
    {
        return $this->userDB->getUserByCredentials($username, $password);
    }

    /**
     * Function to check based on set session, if user's already logged in
     */
    public function isUserLoggedIn()
    {
        $userId = $this->sessionManager->get('_user');
        $user   = $this->userDB->getUserById($userId);
        $this->cacheManager->set('user', $user);
        return ($user instanceof UserModel);
    }

}
