<?php 
// usklađeno sa novom bazom
class Order{

    protected $id_order, $id_user, $id_restaurant, $active, $order_time, $delivery_time, $price_total, $discount, $note, $feedback, $rating, $thumbs_up, $thumbs_down;

    public function __construct($id_order, $id_user, $id_restaurant, $active, $order_time, $delivery_time, $price_total, $discount, $note, $feedback, $rating, $thumbs_up, $thumbs_down )
    {
        $this->id_order = $id_order;
        $this->id_user = $id_user;
        $this->id_restaurant = $id_restaurant;
        $this->active = $active;
        $this->order_time = $order_time;
        $this->delivery_time = $delivery_time;
        $this->price_total = $price_total;
        $this->discount = $discount;
        $this->note = $note;
        $this->id_feedback = $feedback;
        $this->rating = $rating;
        $this->thumbs_up = $thumbs_up;
        $this->thumbs_down = $thumbs_down;

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