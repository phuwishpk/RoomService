document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");

    signupForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (password !== confirmPassword) {
            alert("รหัสผ่านไม่ตรงกัน!");
            return;
        }

        alert("สมัครสมาชิกสำเร็จ! ไปที่หน้าเข้าสู่ระบบ");
        window.location.href = "login.html";
    });
});
