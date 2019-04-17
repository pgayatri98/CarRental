<?php
class CarRentals_Database {
    public $conn = NULL;

    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "anitscse034";
        $dbname = "CarRentals";

        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function print_all($result) {
        while($row = mysqli_fetch_assoc($result)){
          foreach($row as $val) {
              echo "$val ";
          }
          echo "<br>";
        }
    }

    function register($u_id, $password, $name, $email, $phone, $license) {
        $query = "INSERT INTO User
                    VALUES
                    ($u_id, '$password', '$name', '$email', '$phone', '$license', 1)";
        $registration_status = mysqli_query($this->conn, $query);
        return $registration_status;
    }

    function login($user_id, $password) {
        $query = "SELECT u_id FROM User WHERE u_name = '$user_id' AND u_password = '$password'";
        $user = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($user) == 1) {
            $row = mysqli_fetch_assoc($user);
            return $row["u_id"];
        }
        return NULL;
    }

    function search_cars($u_id, $start_time, $return_time, $location) {
        $query = "SELECT C.c_id, C.c_name, C.c_type, C.c_fuel FROM Car C
                  WHERE C.c_location = '$location' 
                  AND C.c_id NOT IN (
                                SELECT B.c_id FROM Booking B
                                WHERE B.start_time < '$start_time' AND B.return_time > '$return_time'
                                ) 
                AND $u_id NOT IN (
                                SELECT B.u_id FROM Booking B
                            )";
        $cars = mysqli_query($this->conn, $query);
        return $cars;
    }

    function book_car($c_id, $u_id, $start_time, $return_time) {
        $query = "INSERT INTO Booking
                    VALUES
                    ($c_id, $u_id, NOW(), '$start_time', '$return_time')";
        $booking_status = mysqli_query($this->conn, $query);
        return $booking_status;
    }

    function cancel_booking($u_id) {
        $query = "SELECT MAX(date_of_booking) FROM Booking";
        $last_booking_res = mysqli_query($this->conn, $query);
        $tuple = mysqli_fetch_assoc($last_booking_res);
        $last_booking = $tuple["MAX(date_of_booking)"];

        $query = "DELETE FROM Booking WHERE u_id = $u_id
                  AND date_of_booking = '$last_booking'";
        $cancellation_status = mysqli_query($this->conn, $query);
        return $cancellation_status;
    }

    function calculate_price($c_id, $hours) {
        $query = "SELECT c_PPH FROM Car WHERE c_id = $c_id";
        $res = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($res);
        $pph = (int)implode("", $row);
        return $pph * $hours;
    }

    function get_all_cars() {
        $query = "SELECT * FROM Car";
        $cars = mysqli_query($this->conn, $query);
        return $cars;
    }

    function get_booking_history($u_id) {
        $query = "SELECT C.c_name, B.start_time, B.return_time
                  FROM Booking B, Car C
                  WHERE C.c_id = B.c_id AND B.u_id = $u_id";
        $booking_history = mysqli_query($this->conn, $query);
        return $booking_history;
    }

    function __destruct() {
        mysqli_close($this->conn);
    }
}
?> 