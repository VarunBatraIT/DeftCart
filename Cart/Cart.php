<?php
/**
 * User: codevarun
 */

namespace Deft\Cart;

use Deft\Storage\StorageInterface;

class Cart
{

    private $type = 'General';

    private $items = array();
    /**
     * @var Storage
     */
    protected $storage;

    /**
     * Initialize type of cart we are dealing with
     * @param Storage $storage
     * @param bool $type
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function  __construct(StorageInterface $storage, $type = false)
    {
        $this->storage = $storage;
        $this->initializeType($type, false);
    }

    public static function getInstance(StorageInterface $storage, $type = false)
    {
        static $instance = null;
        if (null !== $instance) {
            if ($instance->type === $type) {
                return $instance;
            }
        }
        $instance = new static($storage, $type);
        return $instance;
    }


    /**
     * @return array All cart items
     */
    public function getAll()
    {
        return $this->items;
    }

    /**
     * @param $uid
     * @return int Quantity of cart
     */
    public function get($uid)
    {
        if (isset($this->items[$uid]) && $this->items[$uid] > 0) {
            return $this->items[$uid];
        }
        return 0;
    }


    /**
     * Add item to cart
     * @param $uid
     * @param int $quantity
     */
    public function add($uid, $quantity = 1)
    {
        $this->items[$uid] = $this->get($uid) + $quantity;
    }

    /**
     * Minus item to cart
     * @param $uid
     * @param int $quantity
     */
    public function minus($uid, $quantity = 1)
    {
        $currentQuantity = $this->get($uid);
        if ($currentQuantity > 0) {
            $currentQuantity = $currentQuantity - $quantity;
        }
        if ($currentQuantity < 1) {
            $this->remove($uid);
        }
        $this->items[$uid] = $currentQuantity;
    }

    /**
     * Sets quantity of cart
     * @param $uid
     * @param int $quantity
     */
    public function set($uid, $quantity = 1)
    {
        if ($quantity <= 0) {
            return $this->remove($uid);
        }
        $this->items[$uid] = $quantity;
    }

    /**
     * Removes items from cart
     * @param $uid
     */
    public function remove($uid)
    {
        if (isset($this->items[$uid])) {
            unset($this->items[$uid]);
        }
    }

    /**
     * Remove all items from cart
     */
    public function removeAll()
    {
        $this->items = array();
    }

    /**
     * Delete all types of cart
     */
    public function removeAllCarts()
    {
        $this->storage->set(array());
    }


    public function setType($type)
    {
        $this->initializeType($type, true);

    }

    public function store()
    {
        $allCarts = $this->storage->get();
        $allCarts[$this->type] = $this->items;
        $this->storage->set($allCarts);
    }

    /**
     * Commit changes in storage
     */
    public function __destruct()
    {
        $this->store();
    }

    private function initializeType($type, $store = true)
    {

        if ($store) {
            $this->store();
        }
        if ($type) {
            $this->type = $type;
        }
        $allCarts = $this->storage->get();
        //play with only our cart
        $this->items = isset($allCarts[$type]) ? $allCarts[$type] : array();

    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

} 