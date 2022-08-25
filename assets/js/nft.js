'use strict';

// element toggle function
const elemToggleFunc = function (elem) { elem.classList.toggle("active"); }



// navbar variables
const navbar = document.querySelector("[data-navbar]");
const navbarToggleBtn = document.querySelector("[data-navbar-toggle-btn]");

navbarToggleBtn.addEventListener("click", function () { elemToggleFunc(navbar); });



// whishlist button
const whishlistBtn = document.querySelectorAll("[data-whishlist-btn]");

for (let i = 0; i < whishlistBtn.length; i++) {

  whishlistBtn[i].addEventListener("click", function () { elemToggleFunc(this); });

}



// go to top variable
const goTopBtn = document.querySelector("[data-go-top]");

window.addEventListener("scroll", function () {

  if (this.window.scrollY >= 800) {
    goTopBtn.classList.add("active");
  } else {
    goTopBtn.classList.remove("active");
  }

});

// PROFIT MARGIN
function getVals() {
  // get range values
  let parent = this.parentNode;
  let range = parent.getElementsByTagName('input');
  let range1 = parseFloat(range[0].value);
  let range2 = parseFloat(range[2].value);
  let range3 = parseFloat(range[3].value);

  // if(range1 > range2 && range3){
  //   let tmp = range2; 
  // }

  let displayElement = parent.getElementsByClassName('amount')
}