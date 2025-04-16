<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/controllers/BookingController.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if booking ID is provided
if (!isset($_GET['booking_id'])) {
    die('No booking ID provided');
}

$booking_id = $_GET['booking_id'];
$bookingController = new BookingController();

try {
    // Get booking details
    $booking = $bookingController->getBookingById($booking_id);
    if (!$booking) {
        throw new Exception("Booking with ID $booking_id not found");
    }

    // Get schedule and bus details
    $scheduleModel = $bookingController->getScheduleModel();
    $busModel = $bookingController->getBusModel();

    $schedule = $scheduleModel->getScheduleById($booking['schedule_id']);
    if (!$schedule) {
        throw new Exception("Schedule not found for this booking");
    }

    $bus = $busModel->getBusById($schedule['bus_id']);
    if (!$bus) {
        throw new Exception("Bus not found for this schedule");
    }

    // Format dates and times
    $departure_time = strtotime($schedule['departure_time']);
    $departure_date = date('M d, Y', $departure_time);
    $departure_time_formatted = date('h:i A', $departure_time);
    $total_price = number_format($booking['total_price'], 2);

    // Create new TCPDF instance (Landscape, mm units, A5 size)
    $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);
    
    // Set document information
    $pdf->SetCreator('Ticket Booking System');
    $pdf->SetAuthor('Ticket Booking System');
    $pdf->SetTitle('Bus Ticket #' . $booking['booking_id']);
    $pdf->SetSubject('Bus Ticket');
    
    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // Set margins
    $pdf->SetMargins(15, 15, 15);
    
    // Add a page
    $pdf->AddPage();
    
    // Set font
    $pdf->SetFont('helvetica', '', 12);
    
    // Ticket border
    $pdf->Rect(10, 10, 190, 120, 'D');
    
    // Ticket content
    $html = '
    <style>
        .header { 
            text-align: center; 
            margin-bottom: 10px;
            color: #2ecc71;
        }
        h1 {
            color: #2ecc71;
            font-size: 20px;
        }
        .details {
            margin: 10px 0;
        }
        .row { 
            margin-bottom: 8px;
        }
        .label { 
            font-weight: bold; 
            color: #555;
            display: inline-block;
            width: 120px;
        }
        .footer { 
            text-align: center; 
            margin-top: 15px;
            font-size: 10px;
            color: #777;
        }
    </style>
    
    <div class="header">
        <h1>Bus Ticket</h1>
        <p>Booking Reference: #' . htmlspecialchars($booking['booking_id']) . '</p>
    </div>
    
    <div class="details">
        <div class="row">
            <span class="label">Passenger Name:</span>
            <span>' . htmlspecialchars($booking['passenger_name'] ?? 'N/A') . '</span>
        </div>
        <div class="row">
            <span class="label">Bus Name:</span>
            <span>' . htmlspecialchars($bus['bus_name']) . '</span>
        </div>
        <div class="row">
            <span class="label">Route:</span>
            <span>' . htmlspecialchars($schedule['source'] ?? 'N/A') . ' to ' . htmlspecialchars($schedule['destination'] ?? 'N/A') . '</span>
        </div>
        <div class="row">
            <span class="label">Departure Date:</span>
            <span>' . $departure_date . '</span>
        </div>
        <div class="row">
            <span class="label">Departure Time:</span>
            <span>' . $departure_time_formatted . '</span>
        </div>
        <div class="row">
            <span class="label">Seat Numbers:</span>
            <span>' . htmlspecialchars($booking['seat_numbers'] ?? 'N/A') . '</span>
        </div>
        <div class="row">
            <span class="label">Total Paid:</span>
            <span>' . $total_price . ' Taka</span>
        </div>
    </div>
    
    <div class="footer">
        <p>Thank you for booking with us! Please present this ticket when boarding.</p>
        <p>Ticket generated on ' . date('M d, Y h:i A') . '</p>
    </div>';

    // Output HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Generate barcode
    $style = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false,
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 10,
        'stretchtext' => 4
    );
    $pdf->write1DBarcode($booking['booking_id'], 'C39', '', '', '', 15, 0.4, $style, 'N');
    
    // Clear any previous output
    ob_clean();
    
    // Output the PDF for download
    $pdf->Output('BusTicket_' . $booking['booking_id'] . '.pdf', 'D');
    
} catch (Exception $e) {
    // Clean any output before showing error
    ob_clean();
    die('Error generating ticket: ' . $e->getMessage());
}