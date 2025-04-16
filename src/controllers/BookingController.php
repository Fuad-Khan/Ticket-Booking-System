<?php
require_once __DIR__ . '/../model/Booking.php';
require_once __DIR__ . '/../model/Schedule.php';
require_once __DIR__ . '/../model/Bus.php';

class BookingController
{
    private $bookingModel;
    private $scheduleModel;
    private $busModel;
    private $routeModel;

    public function __construct()
    {
        $this->bookingModel = new Booking();
        $this->scheduleModel = new Schedule();
        $this->busModel = new Bus();
    }

    public function getScheduleModel()
    {
        return $this->scheduleModel;
    }

    public function getBusModel()
    {
        return $this->busModel;
    }


    public function getBookingById($booking_id)
    {
        return $this->bookingModel->getById($booking_id);
    }


    public function bookSeats($user_id, $schedule_id, $seat_numbers)
    {
        // Get schedule details
        $schedule = $this->scheduleModel->getScheduleById($schedule_id);
        if (!$schedule) return false;

        // Get bus details
        $bus = $this->busModel->getBusById($schedule['bus_id']);
        if (!$bus) return false;

        // Check if seats are already booked
        $booked_seats = $this->bookingModel->getBookedSeats($schedule_id);
        $all_booked = [];
        foreach ($booked_seats as $seats) {
            $all_booked = array_merge($all_booked, explode(',', $seats));
        }
        foreach ($seat_numbers as $seat) {
            if (in_array($seat, $all_booked)) {
                return false; // One or more seats already booked
            }
        }

        // Create booking
        $total_price = $schedule['price'] * count($seat_numbers);
        $seat_numbers_str = implode(',', $seat_numbers);

        return $this->bookingModel->createBooking($user_id, $schedule_id, $seat_numbers_str, $total_price);
    }

    public function getAvailableSeats($schedule_id)
    {
        $schedule = $this->scheduleModel->getScheduleById($schedule_id);
        if (!$schedule) return [];

        $bus = $this->busModel->getBusById($schedule['bus_id']);
        if (!$bus) return [];

        $total_seats = $bus['total_seats'];
        $booked_seats = $this->bookingModel->getBookedSeats($schedule_id);

        // Flatten all booked seats into a single array
        $all_booked_seats = [];
        foreach ($booked_seats as $seats) {
            $all_booked_seats = array_merge($all_booked_seats, explode(',', $seats));
        }

        // Generate all seats and mark availability
        $seats = [];
        for ($i = 1; $i <= $total_seats; $i++) {
            $seats[$i] = !in_array($i, $all_booked_seats);
        }

        return $seats;
    }

    public function getUserBookings($user_id)
    {
        return $this->bookingModel->getUserBookings($user_id);
    }

    public function getBusDetailsForSchedule($schedule_id)
    {
        // Get schedule details
        $schedule = $this->scheduleModel->getScheduleById($schedule_id);
        if (!$schedule) return null;

        // Get bus details
        $bus = $this->busModel->getBusById($schedule['bus_id']);
        if (!$bus) return null;

        // Get route details
        $route = $this->routeModel->getRouteById($bus['route_id']);
        if (!$route) return null;

        return [
            'bus' => $bus,
            'route' => $route,
            'schedule' => $schedule
        ];
    }

   
    public function cancelBooking($booking_id) {
        try {
            // First verify the booking exists
            $booking = $this->bookingModel->getById($booking_id);
            if (!$booking) {
                return false;
            }
            
            // Update the status to Cancelled
            return $this->bookingModel->cancelBooking($booking_id);
        } catch (Exception $e) {
            error_log('Error cancelling booking: ' . $e->getMessage());
            return false;
        }
    }

    public function getAllBookings()
    { /* ... */
    }
    public function getBookingsByUser($user_id)
    { /* ... */
    }
    public function createBooking($user_id, $schedule_id, $seat_numbers, $total_price, $status = 'Pending')
    { /* ... */
    }
    public function updateBookingStatus($booking_id, $status)
    { /* ... */
    }
    public function deleteBooking($booking_id)
    { /* ... */
    }
}
