<?php
include_once "db_con.php";
class Booking  extends Db
{
    private $bookingid, $userid, $type, $route, $ticketno;

    public function __construct($bookingid = null, $userid = null, $type = null, $route = null, $ticketno = null)
    {
        $this->bookingid = $bookingid;
        $this->userid = $userid;
        $this->type = $type;
        $this->route = $route;
        $this->ticketno = $ticketno;
        parent::__construct();
    }
    public function bookTicket()
    {
        echo   $query = "INSERT INTO `booking`(`userid`,`type`, `route`, `ticketno`) VALUES ('$this->userid','$this->type','$this->route','$this->ticketno')";
        $this->getConnection()->query($query) or die("Failed to book ticket");
    }

    public function getBookings()
    {
        $query = "SELECT `booking`.ticketno,`booking`.type,`train`.trainno ,`route`.from,`route`.to FROM `booking` join `pricing` on `pricing`.route = `booking`.route join `train` on `train`.route = `booking`.route join `route` on `route`.routeid = `train`.route where `booking`.userid = '$this->userid' and `pricing`.class = `booking`.type;";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get users");
        }
    }

    public function getAllBookings()
    {
        $query = "SELECT `booking`.booking_id,`users`.username, `booking`.ticketno,`booking`.type,`train`.trainno ,`route`.from,`route`.to FROM `booking` join `pricing` on `pricing`.route = `booking`.route join `train` on `train`.route = `booking`.route join `route` on `route`.routeid = `train`.route join `users` on `booking`.userid = `users`.user_id where `pricing`.class = `booking`.type;";

        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get booking");
        }
    }

    public function getBookingById($id)
    {
        $query = "SELECT * FROM `booking` where `booking`.booking_id = $id";

        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get users");
        }
    }

    public function deleteBooking()
    {
        $query = "DELETE FROM `booking` WHERE booking_id = '$this->bookingid'";
        $this->getConnection()->query($query);
    }
}
