DeftCart
========

Deadly simple cart that can be used for multiple carts at same time. Only quantity is supported since I only need quantities for now.
Testing on PHP 5.4 



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
        $productCart->delete(1); //Delete id 1
        $productCart->deleteAll(); //Delete all items of this cart
        
        

```
