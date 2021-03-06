<?php

/**
 * Class to manage cart actions
 */
namespace App\Controller;

use App\Controller\BaseController;
use App\Factory;
use App\Model\CartModel;

/**
 * Class to manage cart actions
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class CartController extends BaseController
{

    /**
     * Private caribale used to get Items in DB
     * @var Object
     */
    private $itemsMap;
    /**
     * Private caribale used to get cart details in DB
     * @var Object
     */
    private $cartMap;

    /**
     * Default constructor, used to initialize item DB variable
     */
    public function __construct()
    {
        parent::__construct();
        $this->cartMap  = Factory::getDatabaseFactory()->getCartMap();
        $this->itemsMap = Factory::getDatabaseFactory()->getItemMap();

    }
    /**
     * Function to get all the items for currntly logged in user in cart
     */
    public function showDetails()
    {
        $userId   = $this->getCurrentUser()->getUserId();
        $response = $this->cartMap->getCartItemsByUserId($userId);
        return $this->responseOK($response);
    }

    /**
     * Function to add item to user's cart using itemId
     * @param Integer $itemId Item ID
     */
    public function addItem($itemId)
    {
        $userId    = $this->getCurrentUser()->getUserId();
        $cartModel = new CartModel();
        $cartModel->input(array('itemId' => $itemId, 'userId' => $userId));
        $error = $cartModel->validate();
        if ($error) {
            return $this->responseOK(array('error' => $error));
        }
        $response = $this->cartMap->save($cartModel);
        return $this->responseOK($response);
    }

    /**
     * Function to remove a particular item to user's cart using itemId
     * @param Integer $itemId Item ID
     */
    public function removeItem($itemId)
    {
        $userId    = $this->getCurrentUser()->getUserId();
        $cartModel = new CartModel();
        $cartModel->input(array('itemId' => $itemId, 'userId' => $userId));
        $error = $cartModel->validate();
        if ($error) {
            return $this->responseOK(array('error' => $error));
        }
        $response = $this->cartMap->removeCartItemsByUserId($userId, $itemId);
        return $this->responseOK($response);
    }

    /**
     * Function to clear all items for the loggedin User from Cart
     */
    public function clearCart()
    {
        $userId   = $this->getCurrentUser()->getUserId();
        $response = $this->cartMap->clearCartItemsByUserId($userId);
        return $this->responseOK($response);
    }
}
