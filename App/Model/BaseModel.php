<?php
/**
 * Base class which provides default functions to load data from Model classes
 */
namespace App\Model;

/**
 * Parent Class : BaseModel
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class BaseModel
{
    /**
     * Protected variable to store modifiedBits
     * i.e. Changed input
     * @var Array
     */
    protected $modifiedBits = array();
    /**
     * Private varibale to store Column:Value mappings
     * for SQL Query bindings
     * @var Array
     */
    private $bindings = array();

    /**
     * Function to get Columns
     */
    public function getColumns()
    {
        return $this->keys;
    }

    /**
     * Function to get Column:Value Bindings
     */
    public function getBindings()
    {
        return $this->bindings;
    }

    /**
     * Function to validate if input is correct
     */
    public function validate()
    {
        foreach ($this->validate as $key => $validation) {
            if (!property_exists($this, $key) || preg_match('/^' . $validation . '$/', $this->$key) === 0) {
                return "$key field is invalid";
            }
        }
        return false;
    }

    /**
     * Function to get Primary Key for given table
     */
    public function getPrimaryKey()
    {
        return property_exists($this, 'primary') ? $this->primary : 'id';
    }

    /**
     * Function to check for default primary key
     */
    public function getPrimary()
    {
        return property_exists($this, $this->primary) ? $this->{$this->primary} : null;
    }

    /**
     * Function which manually allows us to set Primary key
     * @param String $value Primary key value
     */
    public function setPrimary($value)
    {
        $this->{$this->primary} = $value;
    }

    /**
     * Function to map input to bindings
     * @param String $input Input from user
     */
    public function input($input)
    {
        foreach ($this->keys as $key) {
            $this->modifiedBits[$key] = 0;
            if (isset($input[$key])) {
                $this->bindings[":$key"] = $this->$key = $input[$key];
                $this->modifiedBits[$key] |= 1;
            }
        }
    }
}
