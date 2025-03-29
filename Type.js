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

document.addEventListener('DOMContentLoaded', () => {
    const slideUpElements = document.querySelectorAll('.slide-up');  // เลือกทุกรูปที่ใช้คลาส .slide-up

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('slide-up');  // เพิ่มคลาส slide-up เมื่อมันปรากฏในหน้าจอ
                observer.unobserve(entry.target);  // หยุดการสังเกตหลังจากเพิ่มคลาส
            }
        });
    }, {
        threshold: 0.2  // เมื่อ 20% ของรูปปรากฏในหน้าจอ
    });

    slideUpElements.forEach(el => observer.observe(el));  // เริ่มต้นการสังเกตทุกรูปที่มีคลาส .slide-up
});

const roomSelect = document.getElementById('room');
const bookButton = document.getElementById('bookButton');
const alertMessage = document.getElementById('alertMessage');

// เช็คสถานะห้องเมื่อเลือกห้อง
roomSelect.addEventListener('change', function () {
    const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
    const roomStatus = selectedRoom.getAttribute('data-status');

    if (roomStatus === 'full') {
        bookButton.classList.add('disabled');
        alertMessage.textContent = 'ห้องเต็มแล้ว';
        bookButton.disabled = true;
    } else {
        bookButton.classList.remove('disabled');
        alertMessage.textContent = '';
        bookButton.disabled = false;
    }
});

// เมื่อคลิกปุ่มจอง
bookButton.addEventListener('click', function () {
    const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
    const roomStatus = selectedRoom.getAttribute('data-status');

    if (roomStatus === 'available') {
        // เปลี่ยนไปยังหน้า .html สำหรับทำสัญญา
        window.location.href = 'contract.php'; // เปลี่ยนเป็นลิงก์หน้าที่คุณต้องการ
    }
});

const fadeElements = document.querySelectorAll('.fade-in');

const options = {
    root: null, // ใช้หน้าต่าง (viewport) ของ browser เป็น root
    rootMargin: '0px', // ไม่ต้องการ margin เพิ่มเติม
    threshold: 0.5 // เมื่อ 50% ขององค์ประกอบปรากฏในหน้าจอ
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        // ถ้าองค์ประกอบปรากฏในหน้าจอ
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in-visible');
            observer.unobserve(entry.target); // เลิกตรวจสอบเมื่อองค์ประกอบปรากฏแล้ว
        }
    });
}, options);

// เริ่มต้นการสังเกต
fadeElements.forEach(element => {
    observer.observe(element);
});


//register