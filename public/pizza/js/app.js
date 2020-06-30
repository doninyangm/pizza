// variables
const cartBtn = document.querySelector(".cart-btn");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM = document.querySelector(".cart");
const cartOverlay = document.querySelector(".cart-overlay");
const cartItems = document.querySelector(".cart-items");
const cartTotal = document.querySelector(".cart-total");
const cartContent = document.querySelector(".cart-content");
const productsDOM = document.querySelector(".products-center");
let cart = [];

// products
class Products {
  async getProducts() {
    try {
      let result = await fetch("/main");
      let data = await result.json();
      // console.log(data);
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

  // addCartItem(item) {
  //   console.log(item);
  //   const div = document.createElement("div");
  //   div.classList.add("cart-item");
  //   div.innerHTML = `<!-- cart item -->
  //           <!-- item image -->
  //           <img src=${item.image} alt="product" />
  //           <!-- item info -->
  //           <div>
  //             <h4>${item.name}</h4>
  //             <h5>$${item.price_dollar}</h5>
  //             <h5>$${item.price_euro}</h5>
  //             <span class="remove-item" data-id=${item.amount}>remove</span>
  //           </div>
  //           <!-- item functionality -->
  //           <div>
  //               <i class="fas fa-chevron-up" data-id=${item.amount}></i>
  //             <p class="item-amount">
  //               ${item.amount}
  //             </p>
  //               <i class="fas fa-chevron-down" data-id=${item.amount}></i>
  //           </div>
  //         <!-- cart item -->
  //   `;
  //   cartContent.appendChild(div);
  // }
  // cartLogic() {
  //   clearCartBtn.addEventListener("click", () => {
  //     this.clearCart();
  //   });
  //   cartContent.addEventListener("click", (event) => {
  //     if (event.target.classList.contains("remove-item")) {
  //       let removeItem = event.target;
  //       let id = removeItem.dataset.id;
  //       cart = cart.filter(item => item.id !== id);
  //       // console.log(cart);
  //       this.setCartValues(cart);
  //       Storage.saveCart(cart);
  //       cartContent.removeChild(removeItem.parentElement.parentElement);
  //       const buttons = [...document.querySelectorAll(".bag-btn")];
  //       buttons.forEach((button) => {
  //         if (parseInt(button.dataset.id) === id) {
  //           button.disabled = false;
  //           button.innerHTML = `<i class="fas fa-shopping-cart"></i>add to bag`;
  //         }
  //       });
  //     } else if (event.target.classList.contains("fa-chevron-up")) {
  //         let addAmount = event.target;
  //         // console.log('add amount id');
  //         let id = addAmount.dataset.id;//getAttribute('data-id').value;//
  //         console.log('amount is ' + id);
  //         console.log(cart);
  //         let tempItem = cart.find(item => item.id === id);
  //         tempItem.amount = tempItem.amount + 1;
  //         Storage.saveCart(cart);
  //         this.setCartValues(cart);
  //         addAmount.nextElementSibling.innerText = tempItem.amount;
  //     } else if (event.target.classList.contains("fa-chevron-down")) {
  //         let lowerAmount = event.target;
  //         let id = lowerAmount.getAttribute('data-id').value;//dataset.id;
  //         let tempItem = cart.find((item) => item.id === id);
  //         tempItem.amount = tempItem.amount - 1;
  //         if (tempItem.amount > 0) {
  //           Storage.saveCart(cart);
  //           this.setCartValues(cart);
  //           lowerAmount.previousElementSibling.innerText = tempItem.amount;
  //         } else {
  //           cart = cart.filter((item) => item.id !== id);
  //           // console.log(cart);
  //           this.setCartValues(cart);
  //           Storage.saveCart(cart);
  //           cartContent.removeChild(lowerAmount.parentElement.parentElement);
  //           const buttons = [...document.querySelectorAll(".bag-btn")];
  //           buttons.forEach((button) => {
  //             if (parseInt(button.dataset.id) === id) {
  //               button.disabled = false;
  //               button.innerHTML = `<i class="fas fa-shopping-cart"></i>add to bag`;
  //             }
  //           });
  //         }
  //       }
  //   });
  // }
  // clearCart() {
  //   cart = [];
  //   this.setCartValues(cart);
  //   Storage.saveCart(cart);
  //   const buttons = [...document.querySelectorAll(".bag-btn")];
  //   buttons.forEach((button) => {
  //     button.disabled = false;
  //     button.innerHTML = `<i class="fas fa-shopping-cart"></i>add to bag`;
  //   });
  //   while (cartContent.children.length > 0) {
  //     cartContent.removeChild(cartContent.children[0]);
  //   }
  //   this.hideCart();
  // }
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
      ui.cartLogic();
    });
});
