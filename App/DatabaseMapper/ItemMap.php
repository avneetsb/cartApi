<?php

/**
 * ItemMap Class, used to handle the items table
 */
namespace App\DatabaseMapper;

/**
 * ItemMap Class, used to handle the items table
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class ItemMap extends ObjectMap
{
    /**
     * Protected variable, used to store static table name
     * @var String
     */
    protected $table = 'items';

    /**
     * Function to get all items in items table
     */
    public function getAllItems()
    {
        return $this->find()->all();
    }

    /**
     * Function to get all items assiciated with a particular Id
     * @param Integer $itemId Item ID
     */
    public function getItemById($itemId)
    {
        return $this->find()->where('itemId', $itemId)->get();
    }

    /**
     * Function to delete an item based on its Id
     * @param Integer $itemId Item ID
     */
    public function deleteItemById($itemId)
    {
        return $this->where('itemId', $itemId)->delete();
    }
}
