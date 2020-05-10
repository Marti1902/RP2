<?php 

class Order{

    protected $id, $id_user, $id_restaurant, $id_food, $how_many_times;

    public function __construct($id, $id_user, $id_restaurant, $id_food, $how_many_times )
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_restaurant = $id_restaurant;
        $this->id_food = $id_food;
        $this->how_many_times = $how_many_times;
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