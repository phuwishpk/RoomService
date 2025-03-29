document.getElementById('reportForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // รับค่าจากฟอร์ม
    const reportType = document.getElementById('reportType').value;

    // ตรวจสอบค่าที่เลือก
    if (!reportType) {
        alert('กรุณาเลือกประเภทของรายงาน');
        return;
    }

    // แสดงผลรายงาน (ตัวอย่าง)
    document.getElementById('reportResult').innerHTML = 
        `<p>กำลังสร้างรายงานประเภท: <strong>${reportType}</strong></p>`;
});
