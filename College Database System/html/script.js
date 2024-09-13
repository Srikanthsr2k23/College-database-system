document.addEventListener("DOMContentLoaded", function(event) {
  var slides = document.querySelectorAll(".slide");
  var currentSlide = 0;
  var prevButton = document.querySelector(".prev");
  var nextButton = document.querySelector(".next");

  function showSlide(n) {
    slides[currentSlide].style.display = "none";
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].style.display = "block";
  }

  function changeSlide(n) {
    showSlide(currentSlide + n);
  }

  prevButton.addEventListener("click", function() {
    changeSlide(-1);
  });

  nextButton.addEventListener("click", function() {
    changeSlide(1);
  });

  showSlide(currentSlide);
});
