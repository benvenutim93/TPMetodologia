<?php
    namespace Repository;

    use Models\User as User;

    class UserRepository
    {        
        private $userList;
        private $fileName;

        public function __construct()
        {
            $this->userList = array();
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

        
        public function Remove($userName)
        {
            $this->RetrieveData();

            $this->userList = array_filter($this->userList, function($users) use($userName){
                return $users->getUsername() != $userName;
            });

            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["name"] = $user->getName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["birthDate"] = $user->getBirthDate();
                $valuesArray["mail"] = $user->getMail();
                $valuesArray["userName"] = $user->getUserName();
                $valuesArray["pass"] = $user->getPass();
                
                
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
                    $user->setDni($valuesArray["dni"]);
                    $user->setBirthDate($valuesArray["birthDate"]);
                    $user->setMail($valuesArray["mail"]);
                    $user->setUserName($valuesArray["userName"]);
                    $user->setPass($valuesArray["pass"]);

                    array_push($this->userList, $user);
                }
            }
        }
    }
?>