<?php
include_once "db_con.php";

class Train extends Db
{
    private $trainid, $trainno, $route, $status, $from, $to;

    public function __construct($trainid = null, $trainno = null, $route = null, $status = null, $from = null, $to = null)
    {
        $this->trainid = $trainid;
        $this->trainno = $trainno;
        $this->route = $route;
        $this->status = $status;
        $this->from = $from;
        $this->to = $to;
        parent::__construct();
    }

    public function allTrains()
    {
        $query = "SELECT   * FROM `train` join `route` on train.route = route.routeid";
        $result =  $this->getConnection()->query($query);

        if ($result) {
            return $result;
        } else {
            die("Failed to get trains");
        }
    }

    public function switchStatus()
    {
        $query = "UPDATE `train` SET `status` =!`status` WHERE `train_id` = $this->trainid";
        $result = $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to update users");
        }
    }

    public function deleteTrain()
    {
        $query = "DELETE FROM `train` WHERE `train_id` = $this->trainid";
        $this->getConnection()->query($query) or die("Failed to delete Train");;
    }
    public function deleteRoute($id)
    {
        echo $query = "DELETE `route`, `train`, `pricing`
        FROM `route`
        LEFT JOIN `train` ON `train`.`route` = `route`.`routeid`
        JOIN `pricing` ON `route`.`routeid` = `pricing`.`route`
        WHERE `route`.`routeid` = $id;
        ";
        $this->getConnection()->query($query) or die("Failed to delete root");;
    }
    public function deletePrice($id)
    {
        $query = "UPDATE `pricing` SET `price`= 0  WHERE `pricing`.price_id = $id";
        $this->getConnection()->query($query) or die("Failed to delete price");;
    }
    public  function addTrain()
    {
        $query = "INSERT INTO `train`(`trainno`, `route`, `status`) VALUES ('$this->trainno','$this->route',$this->status)";
        $this->getConnection()->query($query) or die("Failed to insert Train");
    }

    public function bookingOfRoute($id)
    {
        $query = "SELECT * FROM `route`join `booking` on `booking`.route = `route`.routeid where `route`.routeid = $id";

        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get route");
        }
    }

    public function addRoute()
    {
        $query = "SELECT * FROM `route` WHERE `from` = '$this->from' AND `to` = '$this->to'";
        $result = $this->getConnection()->query($query);

        if ($result->num_rows > 0) {
            return false;
        } else {
            $query = "INSERT INTO `route` (`from`, `to`) VALUES ('$this->from', '$this->to')";
            $result = $this->getConnection()->query($query);
            if ($result) {
                return true;
            } else {
                die("Failed to add route");
            }
        }
    }

    public function getRoutesWithoutTrains()
    {
        $query = "SELECT * FROM `route` 
        LEFT JOIN `train` ON `route`.routeid = `train`.route
        WHERE `train`.route IS NULL;";
        $result = $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to add route");
        }
    }

    public function getAvailableRoutes()
    {
        $query = "SELECT `route`.*,`train`.status,`train`.trainno FROM `route` left join `train` on `route`.routeid = `train`.route";
        $result =  $this->getConnection()->query($query);

        if ($result) {
            return $result;
        } else {
            die("Failed to get routes");
        }
    }

    public function getRouteById($id)
    {
        $query = "SELECT * FROM `route` where `routeid` = $id";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get route");
        }
    }

    public function addTicket($price, $route, $class)
    {
        $query = "INSERT INTO `pricing`(`price`, `route`, `class`) VALUES ('$price','$route','$class')";
        $result =  $this->getConnection()->query($query);
        if (!$result) {
            die("Failed to get route");
        }
    }

    public function getRouteId($from, $to)
    {
        $query = "SELECT `route`.routeid FROM `route` WHERE `from` = '$from' AND `to` = '$to'";
        $result = $this->getConnection()->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            die("Failed to get route");
        }
    }

    public function getPriceByRoute($route)
    {
        $query = "SELECT * from `pricing` where `pricing`.route = $route and`pricing`.price = 0";
        $result = $this->getConnection()->query($query);

        if ($result) {
            return $result;
        } else {
            die("Failed to get route by id");
        }
    }


    public function addPrice($price, $route, $class)
    {
        $query = "UPDATE `pricing` SET `price`='$price' WHERE `route`='$route' and `class`='$class'";
        $result = $this->getConnection()->query($query);
        if (!$result) {
            die("Failed to add price");
        }
    }

    public function displayPrice()
    {
        $query = "SELECT * FROM `pricing`  join `route` on `pricing`.route = `route`.routeid  WHERE `pricing`.price!=0;";
        $result = $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get price");
        }
    }

    public function editPrice($id, $price)
    {
        $query = "UPDATE `pricing` SET `price`=$price WHERE `pricing`.price_id=$id";
        $result = $this->getConnection()->query($query);
        if (!$result) {
            die("Failed to update price");
        }
    }

    public function updateRoot($id)
    {
        echo $query = "SELECT * FROM route where `from`='$this->from' and `to`='$this->to'";
        $result =  $this->getConnection()->query($query);

        if ($result->num_rows > 0) {
            return false;
        } else {
            echo $query = "UPDATE `route` SET `from`='$this->from',`to`='$this->to' WHERE `route`.routeid = '$id'";
            $result =  $this->getConnection()->query($query);
            if (!$result) {
                die("Failed to update root");
            }
            return true;
        }
    }

    public function getAuthRoutes()
    {
        $query = "SELECT  DISTINCT `route`.from,`route`.to,`route`.routeid,`train`.trainno FROM `route` join `train` on `route`.routeid = `train`.route join `pricing` on `pricing`.route = `route`.routeid where `pricing`.price!=0 and `train`.status = 1";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get routes");
        }
    }

    public function getAuthPricing($id)
    {
        $query = "SELECT * FROM `pricing` WHERE `pricing`.route = $id and `pricing`.price!=0";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get routes");
        }
    }

    public function getPriceDetails()
    {
        $query = "SELECT r.from, r.to, r.routeid, t.trainno, p.price, p.class
        FROM (
          SELECT DISTINCT route.from, route.to, route.routeid, train.trainno
          FROM route
          JOIN train ON route.routeid = train.route
          JOIN pricing ON pricing.route = route.routeid
          WHERE pricing.price != 0 AND train.status = 1
        ) AS r
        JOIN pricing AS p ON r.routeid = p.route
        JOIN route ON p.route = route.routeid
        JOIN train AS t ON t.route = route.routeid
        WHERE p.price > 0;
        ";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get prices");
        }
    }
}
