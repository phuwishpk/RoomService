<!-- room_booking.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Room Booking</h2>
        <form method="POST" action="process_booking.php">
            <label for="room">Select a Room:</label>
            <select name="room_id" id="room">
                <option value="">-- Choose a room --</option>
                <?php
                // Fetch room data from database
                $conn = new mysqli('localhost', 'root', '', 'hotelsrs');
                $result = $conn->query("SELECT * FROM rooms WHERE status_ = 'Available'");
                while($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['room_id']}'>{$row['room_number']} - {$row['type']} - {$row['price']} THB</option>";
                }
                ?>
            </select>
            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>

/* styles.css */
body { font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; }
.container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
label { display: block; margin-bottom: 8px; }
select, button { padding: 10px; margin-top: 10px; width: 100%; }

// process_booking.php
<?php
if (isset($_POST['room_id']) && !empty($_POST['room_id'])) {
    $conn = new mysqli('localhost', 'root', '', 'hotel_db');
    $room_id = $_POST['room_id'];
    $result = $conn->query("SELECT * FROM rooms WHERE room_id = $room_id");
    $room = $result->fetch_assoc();

    echo "<h2>Payment</h2>";
    echo "<p>Room: {$room['room_number']}</p>";
    echo "<p>Type: {$room['type']}</p>";
    echo "<p>Price: {$room['price']} THB</p>";
    echo "<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Room:{$room['room_number']}, Price:{$room['price']}THB' alt='QR Code'>";
} else {
    echo "<p>Please select a room.</p>";
}
?>
