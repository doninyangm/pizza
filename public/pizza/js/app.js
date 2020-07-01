// variables

const cartItems = document.querySelector(".cart-items");
const cartTotal = document.querySelector(".cart-total");
const productsDOM = document.querySelector(".products-center");
let cart = [];

// products
class Products {
  async getProducts() {
    try {
      let result = await fetch("/main");
      let data = await result.json();
      data = data.map(product => {
        const { id, name, price_dollar, price_euro, size, description, image } = product;
        return { id, name, price_dollar, price_euro, size, description, image };
      });
      return data;
    } catch (error) {
      console.log(error);
    }
  }
}

// ui
class UI {
  displayProducts(products) {
    let result = "";
    products.forEach((product) => {
      result += `
   <!-- single product -->
        <article class="product">
          <div class="img-container">
            <img
              src="${product.image}"
              alt="product"
              class="product-img"
            />
            <button class="bag-btn" data-id=${product.id}>
              <i class="fas fa-shopping-cart"></i>
              add to bag
            </button>
          </div>
          <h3>${product.name}</h3>
          <h4>$${product.price_dollar} | &euro;${product.price_euro}</h4>
        </article>
        <!-- end of single product -->
   `;
    });
    productsDOM.innerHTML = result;
  }
  getBagButtons() {
    const buttons = [...document.querySelectorAll(".bag-btn")];
    buttons.forEach((button) => {
      let id = button.dataset.id;
      let inCart = cart.find(item => item.id == id);
      if (inCart) {
        button.innerText = "In Cart";
        button.disabled = true;
      } else {
        button.addEventListener("click", (event) => {
          // disable button
          event.target.innerText = "In Bag";
          event.target.disabled = true;
          let buttonID = event.target.dataset.id;
          // AJAX call to fetch One Product
          $.ajax({
            url: `/pizza/${buttonID}`,
            type: 'GET',
            success:function(result){
              let cartItem = { ...result, amount: 1 };
              console.log(cartItem);
          //     let cartItem = { ...Storage.getProduct(id), amount: 1 };
              // cart = [...cart, cartItem];
              if(Storage.getCart().length){
                  let newChart = cartItem;
                  cart.push(newChart);
                  Storage.saveCart(cart);
                  UI.setCartTotal();
              }else{
                cart = [ ...cart, cartItem ];
                Storage.saveCart(cart);
                UI.setCartTotal();
              }
            },
            error: function(error){
              console.log(error);
            }
          });
        });
      }
    });
  }

  static setCartTotal(){
    if(Storage.getCart().length > 0){
        cartItems.innerText = Storage.getCart().length;
    } else{
      console.log(Storage.getCart().length);
      cartItems.innerText = "0";
    }
  }
}

class Storage {
  static saveProducts(products) {
    localStorage.setItem("products", JSON.stringify(products));
  }
  static getProduct(id) {
    let products = JSON.parse(localStorage.getItem("products"));
    return products.find(product => product.id === id);
  }
  static saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
  }
  static getCart() {
    return localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const ui = new UI();
  const products = new Products();

  UI.setCartTotal();
  // get all products
  products
    .getProducts()
    .then((products) => {
      ui.displayProducts(products);
      Storage.saveProducts(products);
    })
    .then(() => {
      ui.getBagButtons();
    });
});
