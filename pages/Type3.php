<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Room Type 1 at RUKSABAI Room Service">
    <meta name="keywords" content="Room, Booking, RUKSABAI">
    <meta name="author" content="Your Name">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="Type.css"> <!-- Ensure this path is valid -->
    <title>Book Your Stay at RUKSABAI | Room Type 3</title>
</head>
<body>
    <nav>
        <div class="nav__bar">
            <div class="logo">
                <div>RSB</div>
                <span>RUKSABAI<br />Room Service</span>
            </div>
            <div class="nav__menu__btn">
                <i class="ri-menu-line"></i>
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

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const user = JSON.parse(localStorage.getItem("user"));
                        const loginLink = document.getElementById("loginLink");
                
                        if (user && user.username) {
                            loginLink.textContent = user.username; // เปลี่ยน "Login" เป็นชื่อผู้ใช้
                            loginLink.href = "#"; // ป้องกันไม่ให้กดกลับไปหน้า Login
                        }
                    });
                </script>
            </ul>
        </div>
    </nav>

    <header class="header">
        <div class="section__container header__container">
            <div class="text-content">
                <p class="section__subheader"></p>
                <h1>Room Type 3</h1>
            </div>
        </div>
    </header>

<main>
    <div class="room-images">
        <img src="../images/S__852000.jpg" alt="Overview of Room 101" class="room-image slide-up">
        <img src="../images/S__12058629_0.jpg" alt="Overview of Room 102" class="room-image slide-up">
        <img src="../images/S__12058631_0.jpg" alt="Overview of Room 103" class="room-image slide-up">
    </div>

    <div class="info-container">
        <div class="info-box fade-in">
            <h2>รายละเอียดห้อง</h2>
            <select name="room_id" id="room">
                <option value=""></option>
                <?php
                // Fetch room data from database
                $conn = new mysqli('localhost', 'root', '', 'hotelsrs');
                $result = $conn->query("SELECT room_number, status FROM rooms WHERE room_number IN (301, 302, 303, 304, 305)");
                while($row = $result->fetch_assoc()) {
                  echo "<option value='{$row['room_id']}' data-status='{$row['status']}'>{$row['room_number']} - {$row['status']}</option>";
              }
                ?>
            </select>
            <button id="bookButton" class="btn-book">จองเลย</button>
            <div id="alertMessage" class="alert"></div>
        </div>

        <div class="info-box fade-in">
            <h3>รายละเอียดเพิ่มเติม</h3>
            <ul>
                <li>เตียง 3.5 ฟุต</li>
                <li>แอร์</li>
                <li>โต๊ะทำงานและเก้าอี้</li>
                <li>เครื่องทำน้ำอุ่น</li>
                <li>WiFi</li>
            </ul>
        </div>

        <div class="info-box fade-in">
            <h3>Location</h3>
            <div class="location-map">
                <iframe 
                    src="https://www.openstreetmap.org/export/embed.html?bbox=-74.006,40.7128,-73.945,40.7484&layer=mapnik" 
                    allowfullscreen></iframe>
                <p>Unable to load the map at this time.</p>
                <p>2 นาที ถึง 7-11</p>
                <p>5 นาที ถึง สวนสาธารณะ</p>
                <p>8 นาที ถึง สนามบิน</p>
                <p>10 นาที ถึง แอร์พอร์ตลิงค์</p>
            </div>
        </div>
    </div>
</main>
    
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="Type.js"></script>
        <script>
            // ดึงข้อมูลห้องจาก PHP
            fetch('get_rooms.php')
                .then(response => response.json())
                .then(rooms => {
                    const roomSelect = document.getElementById('room');
                    rooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.room_number;
                        option.textContent = `ห้อง ${room.room_number} - ${room.status === 'available' ? 'ว่าง' : 'เต็ม'}`;
                        option.setAttribute('data-status', room.status);
                        roomSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching rooms:', error));

            const bookButton = document.getElementById('bookButton');
            const alertMessage = document.getElementById('alertMessage');

            // เมื่อเลือกห้องจาก dropdown
            document.getElementById('room').addEventListener('change', function () {
                const selectedRoom = this.options[this.selectedIndex];
                const roomStatus = selectedRoom.getAttribute('data-status');

                if (roomStatus === 'full') {
                    bookButton.classList.add('disabled');
                    alertMessage.textContent = 'ห้องเต็มแล้ว';
                    bookButton.disabled = true;
                } else if (selectedRoom.value === "") {
                    // If no room is chosen
                    bookButton.disabled = true;
                    alertMessage.textContent = 'กรุณาเลือกห้อง';
                } else {
                    bookButton.classList.remove('disabled');
                    alertMessage.textContent = '';
                    bookButton.disabled = false;
                }
            });

            // เมื่อคลิกปุ่มจอง
            bookButton.addEventListener('click', function () {
                const selectedRoom = document.getElementById('room').options[document.getElementById('room').selectedIndex];
                const roomStatus = selectedRoom.getAttribute('data-status');

                if (roomStatus === 'available') {
                    // ถ้าห้องว่าง พาไปหน้า contract.html
                    window.location.href = 'contract.php'; // เปลี่ยนลิงก์นี้ให้ตรงกับหน้า
                } else {
                    // ถ้าห้องเต็ม แสดงข้อความเตือน
                    alertMessage.textContent = 'ห้องเต็มแล้ว! กรุณาเลือกห้องอื่น';
                }
            });
        </script>
    </main>

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
  
      <script src="https://unpkg.com/scrollreveal"></script>
      <script src="script.js"></script>
    </body>
  </html>
  