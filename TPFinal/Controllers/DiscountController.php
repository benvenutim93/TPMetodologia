<?php

    namespace Controllers;

    use Models\Discount as Discount;
    use DAO\DiscountDao as DiscountDao;


    class DiscountController
    {
        private $discountDao;

        public function __construct()
        {
            $this->discountDao = new DiscountDao();
        }

        public function showOPAdminsView()
        {
            require_once(ADMIN_VIEWS . "boardAdmin.php");
        }
        
        public function Add($percentage, $minCant,$idCinema,$description)
        {
            $discount = new Discount($percentage, $description, $minCant);
            $this->discountDao->Add($discount); //agrega a tabla descuentos
            $result = $this->discountDao->retrieveLastIdDiscount(); //trae ultimo descuento agregado
            $idDiscount = $result["id_discount"];
            $this->discountDao->addDiscountPerCinema($idDiscount,$idCinema); //agrega a tabla descuentosxcine
            $this->showOPAdminsView();
        }
    }
?>