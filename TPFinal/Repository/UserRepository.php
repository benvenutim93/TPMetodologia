<?php
    namespace Repositories;

    use Models\User as User;

    class UserRepository
    {        
        private $userList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/users.json";
        }

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["name"] = $user->getName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["userName"] = $user->getUserName();
                $valuesArray["pass"] = $user->getPass();
                $valuesArray["mail"] = $user->getMail();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["birthDate"] = $user->getBirthDate();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    $user->setName($valuesArray["name"]);
                    $user->setLastName($valuesArray["lastName"]);
                    $user->setUserName($valuesArray["userName"]);
                    $user->setPass($valuesArray["pass"]);
                    $user->setMail($valuesArray["mail"]);
                    $user->setDni($valuesArray["dni"]);
                    $user->setBirthDate($valuesArray["birthDate"]);

                    array_push($this->userList, $user);
                }
            }
        }
    }
?>
