
const carousel = document.getElementById("products-carousel");
const previousButton = document.getElementById("carousel-prev");
const nextButton = document.getElementById("carousel-next");

if (carousel && previousButton && nextButton) {

    nextButton.addEventListener("click", () => {
        carousel.scrollBy({
            left: carousel.clientWidth * 0.8,
            behavior: "smooth"
        });
    });

    previousButton.addEventListener("click", () => {
        carousel.scrollBy({
            left: -carousel.clientWidth * 0.8,
            behavior: "smooth"
        });
    });

}
