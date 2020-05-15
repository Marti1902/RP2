<?php 

class Food{

    protected $id, $name, $food_type, $description, $waiting_time, $id_restaurant, $price;

    public function __construct($id, $name, $food_type, $description, $waiting_time, $id_restaurant, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->food_type = $food_type;
        $this->description = $description;
        $this->waiting_time = $waiting_time;
        $this->id_restaurant = $id_restaurant;
        $this->price = $price;
    }

    public function __get( $property )
    {
        if( property_exists($this, $property))
            return $this->$property;
    }

    public function __set( $property, $value )
    {
        if( property_exists( $this, $property ) )
            $this->$property = $value;
        return $this;
    }

}

?>