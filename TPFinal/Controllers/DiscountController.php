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

        public function showOPAdminsView($msgError = "")
        {
            require_once(ADMIN_VIEWS . "boardAdmin.php");
        }
        
        public function Add($percentage, $minCant,$idCinema,$description)
        {
            try
            {
                $discount = new Discount($percentage, $description, $minCant);
                $this->discountDao->Add($discount); //agrega a tabla descuentos
                $result = $this->discountDao->retrieveLastIdDiscount(); //trae ultimo descuento agregado
                $idDiscount = $result["id_discount"];
                $this->discountDao->addDiscountPerCinema($idDiscount,$idCinema); //agrega a tabla descuentosxcine
            }
            catch (\PDOException $ex)
            {
                $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
                "type" => 1);
                require_once(VIEWS_PATH . "errorView.php");
            }
            finally
            {
                $this->showOPAdminsView();
            }
        }

        public function showDiscountsListCinema($idCinema)
        {
            $discountsList = $this->discountDao->GetAll($idCinema);
            require_once(DISCOUNT_VIEWS . "discountsListCinema.php");

        }
    }
?>