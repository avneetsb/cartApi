<?php

/**
 * Class to handle all Cart Related functionality
 */
namespace App\Model;

use App\Model\BaseModel;

/**
 * Class to handle all Cart Related functionality
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class CartModel extends BaseModel
{
    /**
     * Protected variable to store keys i.e. table columns
     * i.e. columns with user input values
     * @var Array
     */
    protected $keys = array('itemId', 'userId');
    /**
     * Protected variable to validations againt input for columns
     * i.e. columns with user input values
     * BaseModel class validate function uses this
     * @var Array
     */
    protected $validate = array('itemId' => '[0-9]+', 'userId' => '[0-9]+');
    /**
     * Protected variable to default primary key column
     * @var Array
     */
    protected $primary = 'cartId';
}
