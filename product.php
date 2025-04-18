<?php
class Product {
    private $name;
    private $image;
    private $price;

    public function __construct($name, $image, $price) {
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPrice() {
        return $this->price;
    }
}
