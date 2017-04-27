<?php

/**
 * Intermediate controller used to send default response i.e. ERROR
 */
namespace App\Controller;

use App\Controller\BaseController;

/**
 * Intermediate controller used to send default response i.e. ERROR
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class DefaultController extends BaseController
{
    /**
     * Function to send ERROR response
     */
    public function showError()
    {
        return $this->response();
    }
}
