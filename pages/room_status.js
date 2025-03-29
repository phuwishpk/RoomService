document.addEventListener('DOMContentLoaded', function() {
    const bookButton = document.getElementById('bookButton');
    const alertMessage = document.getElementById('alertMessage');
    const bookingModal = document.getElementById('bookingModal');

    // เมื่อคลิกปุ่มจอง
    bookButton.addEventListener('click', function(event) {
        event.preventDefault(); // ป้องกันการดำเนินการเริ่มต้นของปุ่ม

        const selectedRoom = document.getElementById('room').value;
        const selectedOption = document.querySelector(`#room option[value="${selectedRoom}"]`);

        if (selectedOption) {
            const roomStatus = selectedOption.getAttribute('data-status');

            if (selectedRoom === "") {
                alertMessage.textContent = 'กรุณาเลือกห้อง';
                alertMessage.style.color = 'red';
            } else if (roomStatus === 'Available') { // ใช้ 'Available' ให้ตรงกับฐานข้อมูล
                bookingModal.style.display = 'block';
                alertMessage.textContent = '';
            } else {
                alertMessage.textContent = 'ห้องเต็มแล้ว';
                alertMessage.style.color = 'red';
            }
        } else {
            alertMessage.textContent = 'ไม่พบห้องที่เลือก';
            alertMessage.style.color = 'red';
        }
    });

    // เมื่อกดปุ่มย้อนกลับใน modal
    document.getElementById('backButton').addEventListener('click', function() {
        bookingModal.style.display = 'none'; // ปิด modal
    });

    // เมื่อกดปุ่มเสร็จสิ้นใน modal
    document.getElementById('finishButton').addEventListener('click', function() {
        const checkinDate = document.getElementById('checkin-date').value; // วันที่เข้า
        const contractDuration = document.getElementById('contract-duration').value; // ระยะสัญญา
        const roomNumber = document.getElementById('room').value; // ห้องที่เลือก

        // ตรวจสอบว่าได้กรอกข้อมูลครบถ้วน
        if (checkinDate && contractDuration && roomNumber) {
            // ส่งข้อมูลไปยัง PHP เพื่อบันทึกการจอง
            fetch('save_booking.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    room_number: roomNumber,
                    checkin_date: checkinDate,
                    contract_duration: contractDuration
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('ข้อมูลการจองบันทึกสำเร็จ'); // แสดงข้อความเมื่อบันทึกสำเร็จ
                    bookingModal.style.display = 'none'; // ปิด modal
                } else {
                    alert('บันทึกข้อมูลไม่สำเร็จ'); // หากมีข้อผิดพลาดในการบันทึก
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล'); // แสดงข้อผิดพลาดที่เกิดขึ้น
            });
        } else {
            alert('กรุณากรอกข้อมูลให้ครบ'); // ถ้าข้อมูลไม่ครบ
        }
    });
});