<?php

define("BRAND_NAME", "Jean Paul Gaultier");
class Product {
    protected $name;
    protected $image;
    protected $price;

    public function __construct($name, $image, $price) {
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
    }

    // Getters
    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPrice() {
        return $this->price;
    }

    // Për demonstrim të funksioneve string dhe var_dump()
    public function debug() {
        var_dump("Produkti: " . strtoupper($this->name));
    }
}

// Trashëgimi për femra
class WomenProduct extends Product {
    private $category = "Women";

    public function getCategory() {
        return $this->category;
    }
}

// Trashëgimi për meshkuj
class MenProduct extends Product {
    private $category = "Men";

    public function getCategory() {
        return $this->category;
    }
}
?>
