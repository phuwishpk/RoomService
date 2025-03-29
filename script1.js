document.addEventListener("DOMContentLoaded", function () {
    const bookingButtons = document.querySelectorAll(".booking-btn");
    const contractButtons = document.querySelectorAll(".contract-btn");

    // กดปุ่ม "จอง"
    bookingButtons.forEach(button => {
        button.addEventListener("click", function () {
            alert("ห้องถูกจองแล้ว!");
            this.innerText = "ทำสัญญา";
            this.classList.remove("booking-btn");
            this.classList.add("contract-btn");
        });
    });

    // กดปุ่ม "ทำสัญญา"
    contractButtons.forEach(button => {
        button.addEventListener("click", function () {
            alert("การทำสัญญาเสร็จสมบูรณ์!");
            this.innerText = "ทำสัญญาแล้ว";
            this.disabled = true;
        });
    });

    // ค้นหาห้องพัก
    document.getElementById("search-room").addEventListener("input", function () {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll(".booking-list tbody tr");

        rows.forEach(row => {
            let roomNumber = row.cells[0].innerText.toLowerCase();
            row.style.display = roomNumber.includes(searchValue) ? "" : "none";
        });
    });
});
