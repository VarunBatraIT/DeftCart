<?php
/**
 * Just a sample session storage for cart
 * User: codevarun
 */

namespace Deft\Storage\Session;

use Deft\Storage\StorageInterface;

class SessionStorage implements StorageInterface
{

    public function get()
    {
        if (isset($_SESSION[__CLASS__])) {
            return $_SESSION[__CLASS__];
        }
        return array();
    }

    public function set(Array $items)
    {
        $_SESSION[__CLASS__] = $items;
    }

}