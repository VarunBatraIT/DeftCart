<?php
/**
 * Sample test using SessionStorage
 * User: codevarun
 */

require __DIR__.'/../Cart/Cart.php';
require __DIR__.'/../Storage/StorageInterface.php';
require __DIR__.'/../Storage/Session/SessionStorage.php';
require __DIR__.'/../Storage/File/FileStorage.php';

use \Deft\Cart\Cart;
use \Deft\Cart\StorageInterface;
use \Deft\Storage\File\FileStorage;
use \Deft\Storage\Session\SessionStorage;

class CartTest extends \PHPUnit_Framework_TestCase
{
    private $storage;

    public function setup()
    {

        $this->storage = new FileStorage();
//        resets all carts
        $this->storage->set(array());
    }

    public function testMultiCart()
    {
        $productCart = new Cart($this->storage, 'Product');
        $productCart->add(1, 2);
        $this->assertEquals($productCart->get(1), 2);

        //Setting cart type to Membership
        $productCart->setType('Membership');
        $productCart->add(1, 1);
        $this->assertEquals($productCart->get(1), 1);

        //Setting back to Product
        $productCart->setType('Product');
        $this->assertEquals($productCart->get(1), 2);

        //Previous cart as whole new object
        $membershipCart = new Cart($this->storage, 'Membership');
        $this->assertEquals($membershipCart->get(1), 1);
    }

    public function testAddToCart()
    {
        $productCart = new Cart($this->storage, 'testAddToCart');
        $productCart->add(1, 2);
        $this->assertEquals($productCart->get(1), 2);
    }

    public function testRemoveFromCart()
    {
        $productCart = new Cart($this->storage, 'testRemoveFromCart');
        $productCart->add(1, 2);
        $this->assertEquals($productCart->get(1), 2);
        $productCart->remove(1);
        $this->assertEquals($productCart->get(1), 0);
    }

}