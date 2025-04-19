<?php
class GiftProduct {
    private $name;
    private $description;
    private $price;
    private $image;

    public function __construct($name, $description, $price, $image) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage() {
        return $this->image;
    }
}
?>
