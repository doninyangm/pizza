// Variables
const productsDOM = document.querySelector(".item");
const addBtn = document.getElementById('addBtn');
const cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];//JSON.parse(localStorage.getItem('cart'));

const cartUI = (() => {
  let products = JSON.parse(localStorage.getItem('cart'));
  // console.log(products);
  let result = "";
  products.map(product=>{
    result += `
      <tr class="text-center">
          <td scope="row">${product.id}</td>
          <td scope="row"><img src="${product.image}" height="100px" width="100px" class="img-thumbnail" alt=""></td>
          <td scope="row">${product.name}</td>
          <td scope="row" class="dollarPrice">${product.price_dollar}</td>
          <td scope="row" class="euroPrice">${product.price_euro}</td>
          <td scope="row">${product.size}</td>
          <td scope="row"><input type="number" name="" min="1" max="50" class="quantity" value="${product.amount}" size="2"></td>
        </tr>
   `;
    // console.log(product);
  });
  productsDOM.innerHTML = result;
  // Add Button
  if(cart.length == 0){
    addBtn.style.display = 'none';
  }else{
    addBtn.style.display = 'block';
  }
})();

// let cartLength = cart : [];
if(cart.length>0){
  document.querySelector(".cart-items").innerText = cart.length;
}

const quantity = document.querySelectorAll('.quantity');
const dollarPrice = document.querySelectorAll('.dollarPrice');
const euroPrice = document.querySelectorAll('.euroPrice');
const euro = document.querySelector('#euro');
const dollar = document.querySelector('#dollar');

let quantityArr = [];
let totalPriceArr = [];
let itemDollarPrice = 0;
let itemEuroPrice = 0;

const computeTotal = () => {
  // Get Dollar Price
  [...dollarPrice].map(e => {
      itemDollarPrice += parseFloat(e.innerHTML);
  });
  // console.log(itemDollarPrice);

  // Get Euro Price
  [...euroPrice].map(e => {
      itemEuroPrice += parseFloat(e.innerHTML);
  });
  // console.log(itemEuroPrice);
  euro.innerHTML = `&euro;${itemEuroPrice}`;
  dollar.innerHTML = `$${itemDollarPrice}`;
}

const calcTotalPrice = (() => {
  computeTotal();
  // Get amount value
  let itemQuantity = 0;
  [...quantity].map(e => {
    e.addEventListener('change', event => {
      itemQuantity = event.target.value;
      //calculate total
      computeTotal();
    })
  });
})();

addBtn.addEventListener('click', e => {
  quantityArr = [];
  totalPriceArr=[];
  totalPriceArr.push(itemDollarPrice, itemEuroPrice);
  [...quantity].map(e => {
    itemQuantity = e.value;
    quantityArr.push(itemQuantity);
  });
    localStorage.setItem('totalPrice', totalPriceArr);
    localStorage.setItem('itemQuantity', [quantityArr]);
    window.location.href = "/checkout";
});

// cartUI();
// calcTotalPrice();
