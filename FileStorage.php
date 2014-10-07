<?php
/**
 * Just a sample file storage for cart
 * User: codevarun
 */

namespace Deft;


class FileStorage implements Storage
{
    //In practical just file name must depend on session id or at least unique per visitors
    private $fileName = 'cart.json';

    public function get()
    {
        $allCarts = array();
        if (file_exists($this->fileName)) {
            $allCarts = json_decode(file_get_contents('cart.json'), true);
        }

        return $allCarts;
    }

    public function set(Array $items)
    {
        $items = json_encode($items);
        file_put_contents($this->fileName, $items);
    }
}