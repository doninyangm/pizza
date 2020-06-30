const cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];


if(cart.length>0){
  document.querySelector(".cart-items").innerText = cart.length;
}
