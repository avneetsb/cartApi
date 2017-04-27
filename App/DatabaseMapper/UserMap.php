<?php

/**
 * UserMap Class, used to handle the users table
 */
namespace App\DatabaseMapper;

/**
 * UserMap Class, used to handle the users table
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class UserMap extends ObjectMap
{
    /**
     * Protected variable, used to store static table name
     * @var String
     */
    protected $table = 'users';

    /**
     * Function to get user using Id
     * @param Integer $userId User ID
     */
    public function getUserById($userId)
    {
        return $this->find()->where('userId', $userId)->get();
    }

    /**
     * Function to get user details for authentication using username and password
     * @param String $username Username
     * @param String $password Password
     */
    public function getUserByCredentials($username, $password)
    {
        return $this->find()->where('username', $username)->where('password', md5($password))->get();
    }
}
