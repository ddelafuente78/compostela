let currentSlide = 1;
let totalSlides = document.querySelectorAll('.slide ul li').length;

function showSlide(slideIndex) {
    
    document.querySelectorAll('.slide ul li').forEach(function (el) {
        el.style.display = 'none';
    });
    
    document.querySelector('.slide ul li:nth-child(' + slideIndex + ')').style.display = 'block';
}

function nextSlide() {
    currentSlide++;
    if (currentSlide > totalSlides) {
        currentSlide = 1;
    }
    showSlide(currentSlide);
}

setInterval(nextSlide, 4000);


showSlide(currentSlide);
