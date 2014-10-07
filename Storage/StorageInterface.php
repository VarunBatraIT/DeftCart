<?php
/**
 * User: codevarun
 */

namespace Deft\Storage;

interface StorageInterface
{

    /**
     * Get all cart
     * @return mixed
     */
    public function get();

    /**
     * Store all types of cart items
     * @param array $items
     * @return mixed
     */
    public function set(Array $items);

}