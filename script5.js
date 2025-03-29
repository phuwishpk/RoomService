document.addEventListener('DOMContentLoaded', () => {
    const navBar = document.querySelector("nav");
    const bookingBtn = document.querySelector('.booking__btn');
    const bookingMenu = document.querySelector('.booking');

    document.addEventListener("DOMContentLoaded", function () {
    const user = JSON.parse(localStorage.getItem("user"));
    const loginContainer = document.getElementById("loginContainer");
    const loginLink = document.getElementById("loginLink");
    const profileMenu = document.getElementById("profileMenu");
    const profileIcon = document.getElementById("profileIcon");
    const profileDropdown = document.getElementById("profileDropdown");
    const logoutBtn = document.getElementById("logoutBtn");
    const usernameDisplay = document.getElementById("usernameDisplay");

    // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
    if (user && user.username) {
        loginContainer.style.display = "none"; // ซ่อนปุ่ม Login
        profileMenu.style.display = "block"; // แสดงเมนูโปรไฟล์
        usernameDisplay.textContent = user.username; // เปลี่ยนเป็นชื่อผู้ใช้
    } else {
        loginContainer.style.display = "block"; // แสดงปุ่ม Login
        profileMenu.style.display = "none"; // ซ่อนเมนูโปรไฟล์
    }

    // แสดง/ซ่อน dropdown เมื่อคลิกไอคอนโปรไฟล์
    profileIcon.addEventListener("click", function (event) {
        event.stopPropagation(); // ป้องกันการปิดเมนูทันที
        profileDropdown.classList.toggle("show");
    });

    // ซ่อน dropdown เมื่อคลิกที่อื่น
    document.addEventListener("click", function (event) {
        if (!profileIcon.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.remove("show");
        }
    });

    // ระบบออกจากระบบ
    logoutBtn.addEventListener("click", function () {
        localStorage.removeItem("user");
        window.location.href = "login.html";
    });
});

    // ติดตามการ scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
            navBar.classList.add("sticky");
        } else {
            navBar.classList.remove("sticky");
        }
    });

    // แสดงหรือซ่อน dropdown
    bookingBtn.addEventListener('click', (e) => {
        e.preventDefault();
        bookingMenu.classList.toggle('open');
    });

    // ปิด dropdown เมื่อคลิกที่ส่วนอื่น
    document.addEventListener('click', (e) => {
        if (!bookingMenu.contains(e.target) && bookingMenu.classList.contains('open')) {
            bookingMenu.classList.remove('open');
        }
    });

    // ScrollReveal สำหรับการแสดงผล
    const scrollRevealOption = {
        distance: "50px",
        origin: "bottom",
        duration: 1000,
    };

    ScrollReveal().reveal(".header__container .section__subheader", scrollRevealOption);
    ScrollReveal().reveal(".header__container h1", {
        ...scrollRevealOption,
        delay: 500,
    });
    ScrollReveal().reveal(".room__card", {
        ...scrollRevealOption,
        interval: 500,
    });
});
