<?php
class productgifts {
    protected $name;
    protected $description;
    protected $price;
    protected $image;

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

class GiftSet extends  productgifts {
    private $itemsIncluded;

    public function __construct($name, $description, $price, $image, $itemsIncluded) {
        parent::__construct($name, $description, $price, $image);
        $this->itemsIncluded = $itemsIncluded;
    }

    public function getItemsIncluded() {
        return $this->itemsIncluded;
    }
}
?>
