<?php

/**
 * Class to handle all Items Related functionality
 */
namespace App\Model;

use App\Model\BaseModel;

/**
 * Class to handle all Items Related functionality
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class ItemModel extends BaseModel
{
    /**
     * Protected variable to store keys i.e. table columns
     * i.e. columns with user input values
     * @var Array
     */
    protected $keys = array('itemName', 'price');
    /**
     * Protected variable to validations againt input for columns
     * i.e. columns with user input values
     * BaseModel class validate function uses this
     * @var Array
     */
    protected $validate = array('itemName' => '[a-zA-Z0-9 ]+', 'price' => '[0-9]+');
    /**
     * Protected variable to default primary key column
     * @var Array
     */
    protected $primary = 'itemId';
}
