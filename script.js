document.addEventListener("DOMContentLoaded", function () {
    const updateButtons = document.querySelectorAll(".update-status-btn");

    updateButtons.forEach(button => {
        button.addEventListener("click", function () {
            const row = this.closest("tr");
            const selectedStatus = row.querySelector(".status-dropdown").value;
            row.querySelector(".room-status").innerText = selectedStatus;

            alert("เปลี่ยนสถานะห้องเป็น: " + selectedStatus);
        });
    });
});


