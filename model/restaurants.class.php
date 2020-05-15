<?php 

class Restaurants{

    protected $id, $username, $password, $name, $address, $email, $registration_sequance, $rating, $food_type, $description, $has_registered;

    public function __construct($id, $username, $password, $name, $address, $email, $registration_sequance, $rating, $food_type, $description, $has_registered)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password; 
        $this->name = $name;
        $this->address = $address;
        $this->email = $email;
        $this->registration_sequance = $registration_sequance;
        $this->rating = $rating;
        $this->food_type=$food_type;
        $this->description = $description;
        $this->has_registerd = $has_registered;
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