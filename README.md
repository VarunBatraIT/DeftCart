DeftCart
========
Cart class designed to use for multiple carts at same time. You can define your own storage, for sample see FileStorage and SessionStorage. It must implement Storage class

<h2>Multi Cart Library for PHP</h2>

Deadly simple cart that can be used for multiple carts at same time. Only quantity is supported since I only need quantities for now.

Tested on PHP 5.4 



To run test

```
phpunit UniteTest Test/CartTest.php
```

Sample output

```
HeavensMachine% phpunit UniteTest Test/CartTest.php                   
PHPUnit 3.7.28 by Sebastian Bergmann.

...

Time: 26 ms, Memory: 2.75Mb

OK (3 tests, 7 assertions)
```

It has very simple API, sample codes are in test. Following is a sample 

```PHP
        $productCart = new Cart($this->storage, 'Product');
        $productCart->add(1, 2);
      
        //Setting cart type to Membership
        $productCart->setType('Membership');
        $productCart->add(1, 1);

        //Setting back to Product
        $productCart->setType('Product');

        //Previous cart as whole new object but ideally you shouldn't do that since cart is only loaded once. 
        $membershipCart = new Cart($this->storage, 'Membership');
        $productCart->set(1,3); //Sets quanity of id 1 as 3
        $productCart->add(1,3); //Sets quanity of id 1 as 6 (3+3)
        $productCart->minus(1,2); //Now quanity of id is 4
        $productCart->delete(1); //Delete id 1
        $productCart->deleteAll(); //Delete all items of this cart
        $productCart->removeAllCarts(); //Removes all cart not only product cart. Useful to remove junk data. Usually storage should have reset function however I didn't feel like putting that inside interface. Not everyone uses it
        
        

```
