<?php

/**
 * Returns an array of routes available, as well as routes which require authentication
 * and their REQUEST HTTP calling methods which are applicable
 */
return array(
    # authentication
    'POST:/login'            => array('AuthController', 'authenticateUser', false),

    # error
    'ERROR'                  => array('DefaultController', 'showError', false),

    # All the below routes require authentication
    # cart API
    'GET:/cart/items'        => array('CartController', 'showDetails', true),
    'POST:/cart/item/{id}'   => array('CartController', 'addItem', true),
    'DELETE:/cart/item/{id}' => array('CartController', 'removeItem', true),
    'DELETE:/cart/items'     => array('CartController', 'clearCart', true),

    # item API
    'GET:/item'              => array('ItemController', 'searchItems', true),
    'GET:/item/{id}'         => array('ItemController', 'getItemById', true),
    'POST:/item'             => array('ItemController', 'createNewItem', true),
    'POST:/item/{id}'        => array('ItemController', 'updateItem', true),
    'DELETE:/item/{id}'      => array('ItemController', 'deleteItem', true),
);
