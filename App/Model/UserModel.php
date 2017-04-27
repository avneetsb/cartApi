<?php

/**
 * Class for User Handling
 */
namespace App\Model;

use App\Model\BaseModel;

/**
 * Class for User Handling
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class UserModel extends BaseModel
{
    /**
     * Function to get UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
