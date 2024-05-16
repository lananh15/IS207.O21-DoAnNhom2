document.addEventListener("DOMContentLoaded", function() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const images = document.querySelectorAll('.banner img');
    const intervalTime = 4000;
    let currentIndex = 0;

    // Ẩn tất cả các hình ảnh trừ hình ảnh đầu tiên
    images.forEach((img, index) => {
        if (index !== currentIndex) {
            img.style.display = 'none';
        }
    });

    function showNextImage() {
        images[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].style.display = 'block';
    }

    function showPreviousImage() {
        images[currentIndex].style.display = 'none';
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        images[currentIndex].style.display = 'block';
    }


    
    
    // Hàm để tự chuyển đổi giữa 2 banner
    function autoPlay() {
        autoPlayInterval = setInterval(showNextImage, intervalTime);
    }

    autoPlay();

    // Xử lý sự kiện khi người dùng nhấn nút "Previous" và "Next"
    prevBtn.addEventListener('click', function() {
        clearInterval(autoPlayInterval); // Dừng tự động chuyển đổi khi có tương tác với nút "Previous"
        showPreviousImage();
        autoPlay(); 
    });

    nextBtn.addEventListener('click', function() {
        clearInterval(autoPlayInterval); // Dừng tự động chuyển đổi khi có tương tác với nút "Next"
        showNextImage();
        autoPlay(); 
    });
});


