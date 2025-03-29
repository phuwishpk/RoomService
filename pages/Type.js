document.addEventListener('DOMContentLoaded', () => {
    const bookBtn = document.getElementById('bookButton');
    const roomSelect = document.getElementById('room');
    const alertMessage = document.getElementById('alertMessage');

    // ฟังก์ชันแสดงหรือซ่อน Modal
    const modal = document.getElementById('bookingModal');
    const closeModal = document.getElementById('closeModal');
    const selectedRoomInput = document.getElementById('selectedRoomId');

    // เช็คสถานะห้องเมื่อเลือกห้อง
    roomSelect.addEventListener('change', function () {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const roomStatus = selectedRoom.getAttribute('data-status');

        if (roomStatus === 'full') {
            bookBtn.classList.add('disabled');
            alertMessage.textContent = 'ห้องเต็มแล้ว';
            bookBtn.disabled = true;
        } else {
            bookBtn.classList.remove('disabled');
            alertMessage.textContent = '';
            bookBtn.disabled = false;
        }
    });

    // ในฟังก์ชันที่ส่งข้อมูลไปยัง PHP
const formData = new FormData();
const user = JSON.parse(localStorage.getItem("user"));

if (!user || !user.username) {
    alert("กรุณาล็อกอินก่อนจอง");
    window.location.href = "login.html"; // ไปหน้าล็อกอิน
    return;
}

formData.append("username", user.username); // ส่งข้อมูล username
formData.append("room_id", roomId);
formData.append("start_date", startDate);
formData.append("monthly_rent", monthlyRent);

fetch('save_booking.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        // ถ้าจองสำเร็จ
        document.getElementById('selectedRoomId').value = roomId;
        document.getElementById('bookingModal').style.display = 'flex';
    } else {
        alert(data.message); // แสดงข้อความจาก PHP
    }
})
.catch(error => console.error('Error:', error));


    // เมื่อคลิกปุ่มจอง
    bookBtn.addEventListener('click', function () {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const roomStatus = selectedRoom.getAttribute('data-status');

        if (roomStatus === 'available') {
            selectedRoomInput.value = selectedRoom.value;
            modal.style.display = 'flex';  // แสดง Modal เมื่อห้องว่าง
        } else {
            alertMessage.textContent = 'ห้องเต็มแล้ว! กรุณาเลือกห้องอื่น';
        }
    });

    // เมื่อคลิกปุ่มปิด Modal
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // เมื่อคลิกที่นอก Modal ให้ปิดมัน
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});

// การส่งข้อมูลจาก Modal ไปยัง save_booking.php
document.getElementById('bookingForm').addEventListener('submit', function (e) {
    e.preventDefault();  // ป้องกันการรีเฟรชหน้าจอ

    const formData = new FormData(this);
    formData.append('username', JSON.parse(localStorage.getItem("user")).username);  // รับ username จาก localStorage

    // ส่งข้อมูลไปยัง save_booking.php
    fetch('save_booking.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);  // แสดงข้อความสำเร็จ
            window.location.href = 'contract.php';  // ไปหน้าทำสัญญา
        } else {
            alert(data.message);  // แสดงข้อความผิดพลาด
        }
    })
    .catch(error => console.error('Error:', error));
});
