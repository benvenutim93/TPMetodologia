<?php
namespace Controllers;

Use Models\Admin as Admin;
Use Models\Cinema as Cinema;
Use DAO\UserDao as U_DAO;
use DAO\PurchaseDao as P_DAO;
use DAO\CinemaDao as C_DAO;



class AdminController
{
    private $userDao;
    private $purchaseDao;
    private $cinemaDao;
    public function __construct()
    {
            $this->userDao= new U_DAO();
            $this->purchaseDao= new P_DAO();
            $this->cinemaDao = new C_DAO();
    }


    public function showPrincipalView ($msgError = "")
    {
        require_once(ADMIN_VIEWS . "eleccion.php");
    }
    
    public function showOPAdminsView($msgError = "")
    {
        require_once(ADMIN_VIEWS . "boardAdmin.php");
    }
    public function showOPUsersView($msgError = "")
    {
        require_once(USER_VIEWS . "board.php");
    }

    public function showCinemaListPurchase()
    {
        $arrayC= $this->cinemaDao->GetAll();
        require_once(PURCHASE_VIEWS . "eleccion-cinema.php");
    }

    public function showFormVentas($idCinema)
    {
        require_once(PURCHASE_VIEWS . "form-ventas.php");
    }

    public function showPurcharses($dateInicial,$dateFinal,$idCinema)
    {
        $salesList=$this->purchaseDao->getPurcharseCinema($dateInicial,$dateFinal,$idCinema);
        $sale = round($salesList[0]["total"],2); //saca decimales de la variable y desa solo 2
        require_once(PURCHASE_VIEWS ."salesList.php");
    }

    public function loginForm ($msgError = "")
    {
        require_once(ADMIN_VIEWS . "adminLogIn.php");
    }

}
?>