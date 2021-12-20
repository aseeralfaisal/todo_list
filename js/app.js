const close = document.querySelector(".close");
const closeSpan = document.querySelector(".close span");

isOpen = false;

close.addEventListener("click", () => {
  if (isOpen) {
    document.querySelector(".sidebar").style.right = "-110%";
    closeSpan.className = "fa fa-bars";
    isOpen = false;
  } else {
    document.querySelector(".sidebar").style.right = "0";
    closeSpan.className = "fa fa-times";
    isOpen = true;
  }
});
