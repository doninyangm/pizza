// For adding the token to axios header (add this only one time).
var token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

const payBtn = document.querySelector('.pay-btn');
let name = document.getElementById('name').value;
let email = document.getElementById('email').value;
let number = document.getElementById('number').value;
let postCode = document.getElementById('postalCode').value;
let address = document.getElementById('address').value;
const total = document.getElementById('checkoutTotal');
const payForm = document.getElementById('payForm');
// Update total Price in UI
let totalPrices = localStorage.getItem('totalPrice');
totalPrices = totalPrices.split(',');
total.innerHTML = `$${totalPrices[0]} | &euro;${totalPrices[1]}`;

// destructuring array to get prices
const [dollarPrice, euroPrice] = totalPrices;

// Get item quantities from localStorage
let quantities = localStorage.getItem('itemQuantity');
quantities = quantities.split(',');

// Get cart from localStorage
let cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : []; //JSON.parse(localStorage.getItem('cart'));
if(cart.length>0){
  document.querySelector(".cart-items").innerText = cart.length;
}

// Data to be sent to Endpoint
let userData = {
  name: name,
  email: email,
  phone: number,
  postalCode: postCode,
  address: address,
  dollarPrice: dollarPrice,
  euroPrice: euroPrice,
  cart: cart,
  quantities: quantities
};


payForm.addEventListener('submit', e => {
  e.preventDefault();
  axios.post("/order", userData).then(response => {
    // console.log(response);
    swal("Order placed!", "Thanks for choosing Us", "success")
    .then((value) => {
        //clear $quantities
        //clear chart;
        window.location.href = "/history";
    });
  })
});
