<?php
/**
 * Class to handle Login for user authentication
 */
namespace App\Controller;

use App\Controller\BaseController;
use App\Factory;

/**
 * Class to handle Login for user authentication
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class AuthController extends BaseController
{
    /**
     * Function to authenticate used based on incoming params
     * from Request Object
     */
    public function authenticateUser()
    {
        $username = $this->getRequest()->getPOST('username');
        $password = $this->getRequest()->getPOST('password');

        $response = Factory::getAuthManager()->authenticate($username, $password);
        return $this->responseOK($response);
    }
}
