<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Room Type 1 at RUKSABAI Room Service">
    <meta name="keywords" content="Room, Booking, RUKSABAI">
    <meta name="author" content="Your Name">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="Type.css">
    <title>Book Your Stay at RUKSABAI | Room Type 1</title>
    <style>
      .booking-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
      }

      .booking-modal-content {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        width: 300px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      }

      .booking-modal-content label {
        display: block;
        margin-top: 1rem;
      }

      .booking-modal-content input,
      .booking-modal-content select {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.25rem;
        border-radius: 6px;
        border: 1px solid #ccc;
      }

      .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
      }

      .btn-green {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
      }

      .btn-red {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
      }
    </style>
</head>
<?php include('../dbconnect.php'); ?>
<body>
<nav>
    <div class="nav__bar">
        <div class="logo">
            <div>RSB</div>
            <span>RUKSABAI<br />Room Service</span>
        </div>
        <ul class="nav__links">
            <li><a href="../index.html">Home</a></li>
            <li><a href="../index.html#about">About</a></li>
            <li><a href="../index.html#room">Room</a></li>
            <li class="booking">
                <a href="#" class="booking__btn">Booking</a>
                <ul class="booking-dropdown">
                    <li><a href="Type1.php">Room Type 1</a></li>
                    <li><a href="Type2.php">Room Type 2</a></li>
                    <li><a href="Type3.php">Room Type 3</a></li>
                </ul>
            </li>
            <li><a href="Service.html">Service</a></li>
            <li><a id="loginLink" href="../login.html">Login</a></li>
        </ul>
    </div>
</nav>

<header class="header">
    <div class="section__container header__container">
        <div class="text-content">
            <h1>Room Type 1</h1>
        </div>
    </div>
</header>

<main>
  <div class="room-images">
      <img src="../images/S__851988.jpg" alt="Overview of Room 101" class="room-image">
      <img src="../images/S__851993_0.jpg" alt="Overview of Room 102" class="room-image">
      <img src="../images/S__851995_0.jpg" alt="Overview of Room 103" class="room-image">
  </div>
  <div class="info-container">
      <div class="info-box">
          <h2>รายละเอียดห้อง</h2>
          <form id="roomForm">
              <label for="room">เลือกห้อง:</label>
              <select name="room_id" id="room">
                  <option value="">-- กรุณาเลือกห้อง --</option>
                  <?php
                  // ดึงห้องจากฐานข้อมูลและเช็คสถานะห้อง
                  $result = $conn->query("SELECT room_id, room_number, status FROM rooms WHERE room_number IN (101, 102, 103, 104, 105)");
                  while($row = $result->fetch_assoc()) {
                      $room_id = $row['room_id'];
                      $status = $row['status'] == 'available' ? '' : 'disabled style="color: gray;"'; // ป้องกันการจองห้องที่ไม่ว่าง
                      echo "<option value='{$room_id}' {$status}>{$row['room_number']} - {$row['status']}</option>";
                  }
                  ?>
              </select>
              <button type="button" id="bookButton" class="btn-book">จองเลย</button>
          </form>
      </div>
      <div class="info-box">
          <h3>รายละเอียดเพิ่มเติม</h3>
          <ul>
              <li>เตียง 3.5 ฟุต</li>
              <li>แอร์</li>
              <li>โต๊ะทำงานและเก้าอี้</li>
              <li>เครื่องทำน้ำอุ่น</li>
              <li>WiFi</li>
          </ul>
      </div>
  </div>
</main>

<!-- Modal Popup -->
<div id="bookingModal" class="booking-modal" style="display: none;">
  <div class="booking-modal-content">
    <h3>กรุณากรอกข้อมูลการจอง</h3>
    <form id="bookingForm" method="POST" action="save_booking.php">
      <input type="hidden" name="room_id" id="selectedRoomId">
      
      <label for="start_date">วันที่เข้า:</label>
      <input type="date" name="start_date" id="start_date" required>

      <label for="monthly_rent">ระยะสัญญา:</label>
      <select name="monthly_rent" id="monthly_rent" required>
        <option value="">-- เลือก --</option>
        <option value="1">1 เดือน</option>
        <option value="2">2 เดือน</option>
        <option value="3">3 เดือน</option>
        <option value="6">6 เดือน</option>
        <option value="12">1 ปี</option>
      </select>

      <div class="button-container">
        <button type="submit" class="btn-green">เสร็จสิ้น</button>
        <button type="button" id="closeModal" class="btn-red">ย้อนกลับ</button>
      </div>
    </form>
  </div>
</div>


<footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo footer__logo">
            <div>RSB</div>
            <span>RUKSABAI<br />Room Service</span>
          </div>
          <p class="section__description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
            laudantium unde. Doloremque eaque debitis laborum labore voluptates
            iste molestiae consectetur.
          </p>
          <ul class="footer__socials">
            <li>
              <a href="#"><i class="ri-youtube-fill"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-instagram-line"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-facebook-fill"></i></a>
            </li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Contact Us</h4>
          <div class="footer__links">
            <li>
              <span><i class="ri-phone-fill"></i></span>
              <div>
                <h5>Phone Number</h5>
                <p>+89 0611404146</p>
              </div>
            </li>
            <li>
              <span><i class="ri-record-mail-line"></i></span>
              <div>
                <h5>Email</h5>
                <p>RUKSABAI@gmail.com</p>
              </div>
            </li>
            <li>
              <span><i class="ri-map-pin-2-fill"></i></span>
              <div>
                <h5>Location</h5>
                <p>BK Ladkrabang</p>
              </div>
            </li>
          </div>
        </div>
      </div>
    </footer>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const user = JSON.parse(localStorage.getItem("user"));
    const loginLink = document.getElementById("loginLink");
    if (user && user.username) {
      loginLink.textContent = user.username;
      loginLink.href = "#";
    }

    const modal = document.getElementById('bookingModal');
    const bookBtn = document.getElementById('bookButton');
    const closeBtn = document.getElementById('closeModal');
    const roomSelect = document.getElementById('room');
    const selectedRoomIdInput = document.getElementById('selectedRoomId');

    bookBtn.addEventListener('click', function () {
      const roomId = roomSelect.value;
      if (!roomId) {
        alert("กรุณาเลือกห้องก่อนจอง");
        return;
      }
      selectedRoomIdInput.value = roomId;
      modal.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function () {
      modal.style.display = 'none';
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
  const bookBtn = document.getElementById('bookButton');
  const roomSelect = document.getElementById('room');

  bookBtn.addEventListener('click', function () {
    const roomId = roomSelect.value;
    const user = JSON.parse(localStorage.getItem("user"));

    if (!user || !user.username) {
      alert("กรุณาล็อกอินก่อนจอง");
      window.location.href = "login.html";
      return;
    }

    if (!roomId) {
      alert("กรุณาเลือกห้องก่อนจอง");
      return;
    }

    const formData = new FormData();
    formData.append("username", user.username);
    formData.append("room_id", roomId);
    formData.append("start_date", document.getElementById('start_date').value); // date
    formData.append("monthly_rent", document.getElementById('monthly_rent').value); // monthly rent

    console.log("Form Data:", formData); // ตรวจสอบข้อมูลที่ส่งไป

    fetch('save_booking.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.getElementById('selectedRoomId').value = roomId;
        document.getElementById('bookingModal').style.display = 'flex';
      } else {
        alert(data.message); // ข้อความที่แสดงจาก PHP
      }
    })
    .catch(error => console.error('Error:', error));
  });
});
</script>

</body>
</html>