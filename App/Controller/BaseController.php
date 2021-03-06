<?php

/**
 * Base Controller is a common class which provides default functions that can be accessed by
 * individual controllers
 */
namespace App\Controller;

use App\Factory;

/**
 * Base Controller is a common class which provides default functions that can be accessed by
 * individual controllers
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class BaseController
{
    /**
     * Private varibale, used to store incoming Request Object
     * @var Object
     */
    private $request;

    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * Function to set incoming Request Params
     * @param Object $request Request Object
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Function to fetch Reques
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Function to get Currently logged in user, required for checking authentication
     */
    public function getCurrentUser()
    {
        return Factory::getCacheManager()->get('user');
    }

    /**
     * Function to send 200 HTTP response
     * @param Array $array Response Array
     */
    public function responseOK($array)
    {
        $this->setStatusHeaders(200);
        $this->renderJSON($array);
    }

    /**
     * Function to set status code and message for response
     */
    public function response()
    {
        $statusCode = $this->request->getStatusCode();
        $statusMsg  = $this->getStatusMessages($statusCode);
        $this->setStatusHeaders($statusCode);
        $this->renderJSON(array('msg' => $statusMsg));
    }

    /**
     * Function to send 403 Forbidden Access response, in case uer authentication is required
     * @param Array $array Response Array
     */
    public function responseForbidden($array)
    {
        $this->setStatusHeaders(403);
        $this->renderJSON($array);
    }

    /**
     * Function to send response in JSON by setting PHP Headers
     * @param Array $array Response Array
     */
    private function renderJSON($array)
    {
        header('Content-Type:application/json');
        echo json_encode($array);
    }

    /**
     * Function to get status messages based on statusCode
     * @param Integer $status Status Code
     */
    private function getStatusMessages($status)
    {
        switch ($status) {
            case 500:return "Internal Server Error";
            case 403:return "Access Denied";
            default:return "Page Not Found";
        }
    }

    /**
     * Function to set statusheader based on statusCode
     * @param Integer $status Status Code
     */
    private function setStatusHeaders($status)
    {
        switch ($status) {
            case 200:header("HTTP/1.1 200 OK");
                break;
            case 403:header("HTTP/1.1 403 Forbidden");
                break;
            default:header("HTTP/1.1 404 Not Found");
                break;
        }
    }
}
