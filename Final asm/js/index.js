// ========== SLIDER ==========
let slide_index = 0
let slide_play = true
let slides = document.querySelectorAll('.slide')

function hideAllSlide() {
    slides.forEach(e => e.classList.remove('active'))
}

function showSlide() {
    hideAllSlide()
    slides[slide_index].classList.add('active')
}

function nextSlide() {
    slide_index = (slide_index + 1) % slides.length
}

function prevSlide() {
    slide_index = (slide_index - 1 + slides.length) % slides.length
}

document.querySelector('.slider').addEventListener('mouseover', () => slide_play = false)
document.querySelector('.slider').addEventListener('mouseleave', () => slide_play = true)

document.querySelector('.slide-next').addEventListener('click', () => {
    nextSlide()
    showSlide()
})

document.querySelector('.slide-prev').addEventListener('click', () => {
    prevSlide()
    showSlide()
})

showSlide()

setInterval(() => {
    if (!slide_play) return
    nextSlide()
    showSlide()
}, 4477);

// let products = [
//     {
//         name: 'Alienware M17 R5',
//         image1: '/wp-content/themes/nolapnolife/images/Alienware_M17_R5-inn.png',
//         image2: '/wp-content/themes/nolapnolife/images/Alienware_M17_R5-in.png',
//         old_price: '2500',
//         curr_price: '2200'
//     },
//     {
//         name: 'Alienware X16 R2',
//         image1: '/wp-content/themes/nolapnolife/images/Alienware-x16-R2-6-inn.png',
//         image2: '/wp-content/themes/nolapnolife/images/alienware-x16-r2-5-29b2a67d-eb59-474d-b890-5363889cefd2.webp',
//         old_price: '2700',
//         curr_price: '2400'
//     },
//     {
//         name: 'ASUS ROG Strix G17',
//         image1: '/wp-content/themes/nolapnolife/images/asus-rog-strix-g17-inn-.png',
//         image2: '/wp-content/themes/nolapnolife/images/Rog_strix_g17_in-.png',
//         old_price: '2100',
//         curr_price: '1850'
//     },
//     {
//         name: 'Predator Helios 300',
//         image1: '/wp-content/themes/nolapnolife/images/acer_predator_helios_300_inn.png',
//         image2: '/wp-content/themes/nolapnolife/images/predator-helios-300-in.png',
//         old_price: '2000',
//         curr_price: '1700'
//     },
//     {
//         name: 'Predator Raider PH16',
//         image1: '/wp-content/themes/nolapnolife/images/predator-helios-16-ph16-inn.png',
//         image2: '/wp-content/themes/nolapnolife/images/predator_helios_16_in.png',
//         old_price: '2300',
//         curr_price: '2000'
//     },
//     {
//         name: 'MSI GE76 Raider',
//         image1: '/wp-content/themes/nolapnolife/images/raider-ge76-inn.png',
//         image2: '/wp-content/themes/nolapnolife/images/msi-ge76-raider-2021-in-.png',
//         old_price: '2800',
//         curr_price: '2500'
//     },
//     {
//         name: 'MSI Raider GE68 HX',
//         image1: '/wp-content/themes/nolapnolife/images/Raider 68 HX in.webp',
//         image2: '/wp-content/themes/nolapnolife/images/Rader 68 HX inn.png',
//         old_price: '2600',
//         curr_price: '2300'
//     },
// ];


// let product_list = document.querySelector('#latest-products')
// let best_product_list = document.querySelector('#best-products')

// products.forEach(e => {
//     let prod = `
//         <div class="col-3 col-md-6 col-sm-12">
//             <div class="product-card">
//                 <div class="product-card-img">
//                     <img src="${e.image1}" alt="">
//                     <img src="${e.image2}" alt="">
//                 </div>
//                 <div class="product-card-info">
//                     <div class="product-btn">
//                         <button class="btn-flat btn-hover btn-shop-now">shop now</button>
//                         <button class="btn-flat btn-hover btn-cart-add">
//                             <i class='bx bxs-cart-add'></i>
//                         </button>
//                         <button class="btn-flat btn-hover btn-cart-add">
//                             <i class='bx bxs-heart'></i>
//                         </button>
//                     </div>
//                     <div class="product-card-name">
//                         ${e.name}
//                     </div>
//                     <div class="product-card-price">
//                         <span><del>${e.old_price}</del></span>
//                         <span class="curr-price">${e.curr_price}</span>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `

//     product_list.insertAdjacentHTML("beforeend", prod)
//     best_product_list.insertAdjacentHTML("afterbegin", prod)
// })
// ========== LOGIN/REGISTER/LOGOUT ==========
const loginModal = document.getElementById('login-modal');
const userIcon = document.querySelector('.bx-user-circle');
const userMenu = document.querySelector('.user-menu');
const closeModalBtn = document.querySelector('.close-modal');
const tabLogin = document.getElementById('tab-login');
const tabRegister = document.getElementById('tab-register');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const toast = document.getElementById('toast');

function showToast(message) {
    toast.innerText = message;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Show login modal when click User Icon
if (userIcon) {
    userIcon.addEventListener('click', (e) => {
        e.preventDefault();
        loginModal.style.display = 'flex';
    });
}

// Close modal
if (closeModalBtn) {
    closeModalBtn.addEventListener('click', () => {
        loginModal.style.display = 'none';
    });
}
window.addEventListener('click', (e) => {
    if (e.target === loginModal) loginModal.style.display = 'none';
});

// Switch Tabs
tabLogin.addEventListener('click', () => {
    tabLogin.classList.add('active');
    tabRegister.classList.remove('active');
    loginForm.classList.add('active');
    registerForm.classList.remove('active');
});
tabRegister.addEventListener('click', () => {
    tabRegister.classList.add('active');
    tabLogin.classList.remove('active');
    registerForm.classList.add('active');
    loginForm.classList.remove('active');
});

// Register
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const fullname = registerForm.querySelector('input[placeholder="Full Name"]').value;
    const email = registerForm.querySelector('input[placeholder="Email"]').value;
    const password = registerForm.querySelector('#reg-password').value;
    const confirm = registerForm.querySelector('#reg-confirm-password').value;
    const errorBox = document.getElementById('register-error');

    fetch(`${window.location.origin}/wp-content/themes/nolapnolife/auth.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'register', fullname, email, password, confirm })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            errorBox.innerText = 'Đăng ký thành công! Bạn có thể đăng nhập.';
            errorBox.style.color = 'green';
            tabLogin.click();
        } else {
            errorBox.innerText = data.message || 'Đăng ký thất bại.';
            errorBox.style.color = 'red';
        }
    });
});

// Login
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = loginForm.querySelector('input[placeholder="Email"]').value;
    const password = loginForm.querySelector('input[placeholder="Password"]').value;
    const errorBox = document.getElementById('login-error');

    fetch(`${window.location.origin}/wp-content/themes/nolapnolife/auth.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'login', email, password })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            setTimeout(() => location.reload(), 1000);
        } else {
            errorBox.innerText = data.message || 'Đăng nhập thất bại.';
            errorBox.style.color = 'red';
        }
    });
});

// Check session & render avatar + logout
document.addEventListener('DOMContentLoaded', function() {
    function checkLoginStatus(callback) {
        fetch('/wp-content/themes/nolapnolife/auth.php?action=session')
            .then(res => res.json())
            .then(data => {
                callback(data.loggedIn, data.user || {});
            })
            .catch(() => {
                callback(false, {});
            });
    }

    checkLoginStatus((loggedIn, user) => {
        if (loggedIn && user.fullname) {
            if (userIcon) userIcon.style.display = 'none'; // Ẩn icon user mặc định

            const avatarImg = document.createElement('img');
            avatarImg.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.fullname)}&background=random&size=128`;
            avatarImg.alt = 'User Avatar';
            avatarImg.style.width = '40px';
            avatarImg.style.height = '40px';
            avatarImg.style.borderRadius = '50%';
            avatarImg.style.cursor = 'pointer';

            const avatarLink = document.createElement('a');
            avatarLink.href = '/user-profile';
            avatarLink.appendChild(avatarImg);

            const avatarItem = document.createElement('li');
            avatarItem.appendChild(avatarLink);

            // Thêm nút Logout
            const logoutItem = document.createElement('li');
            const logoutBtn = document.createElement('button');
            logoutBtn.innerText = 'Logout';
            logoutBtn.style.marginLeft = '15px';
            logoutBtn.style.background = 'none';
            logoutBtn.style.border = 'none';
            logoutBtn.style.color = 'red';
            logoutBtn.style.cursor = 'pointer';
            logoutBtn.style.fontWeight = '600';
            logoutItem.appendChild(logoutBtn);

            userMenu.appendChild(avatarItem);
            userMenu.appendChild(logoutItem);

            // Bắt sự kiện logout
            logoutBtn.addEventListener('click', () => {
                fetch('/wp-content/themes/nolapnolife/auth.php?action=logout')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        }
                    });
            });
        }
    });
});


// ================= GIỎ HÀNG =================
document.addEventListener('DOMContentLoaded', function () {
    const cartIcon = document.getElementById('cart-icon');
    const cartSidebar = document.getElementById('cart-sidebar');
    const closeCart = document.querySelector('.close-cart');

    if (cartIcon) {
        cartIcon.addEventListener('click', function () {
            cartSidebar.classList.add('active');
            renderCart();
        });
    }

    if (closeCart) {
        closeCart.addEventListener('click', function () {
            cartSidebar.classList.remove('active');
        });
    }

    setupAddToCartButtons();
    renderCart();
});

function setupAddToCartButtons() {
    const buttons = document.querySelectorAll('.btn-cart-add');
    buttons.forEach(btn => {
        btn.addEventListener('click', function () {
            const productCard = btn.closest('.product-card');
            if (!productCard) return;

            const nameElement = productCard.querySelector('.product-card-name');
            const priceElement = productCard.querySelector('.curr-price');
            const imgElement = productCard.querySelector('img');

            if (!nameElement || !priceElement || !imgElement) {
                showToast('Không thể thêm sản phẩm lỗi!');
                return;
            }

            const name = nameElement.innerText.trim();
            const price = priceElement.innerText.trim();
            const img = imgElement.getAttribute('src');

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingProduct = cart.find(item => item.name === name);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ name, price, img, quantity: 1 });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            showToast('Đã thêm sản phẩm vào giỏ hàng!');
            animateCartIcon();
            renderCart();
        });
    });
}

function renderCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';

    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="empty-cart">Chưa có sản phẩm nào trong giỏ!</div>';
    } else {
        cart.forEach((item, index) => {
            const div = document.createElement('div');
            div.classList.add('cart-item');
            div.innerHTML = `
                <img src="${item.img}" alt="">
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">${item.price}</div>
                    <div class="cart-item-quantity">x${item.quantity}</div>
                </div>
                <button class="btn-remove-cart-item" data-index="${index}" title="Xóa sản phẩm">🗑️</button>
            `;
            cartItems.appendChild(div);
        });
    }

    updateCartTotal();
    bindRemoveItemButtons();
}

function bindRemoveItemButtons() {
    const removeButtons = document.querySelectorAll('.btn-remove-cart-item');
    removeButtons.forEach(btn => {
        btn.onclick = function () {
            const index = parseInt(this.getAttribute('data-index'));
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            if (!isNaN(index) && cart[index]) {
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                showToast('Đã xóa sản phẩm!');
                animateCartIcon();
                renderCart();
            }
        };
    });
}

function updateCartTotal() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    let total = 0;
    cart.forEach(item => {
        let price = parseFloat(item.price.replace(/[^\d]/g, "")) || 0;
        total += price * (item.quantity || 1);
    });

    document.getElementById('cart-total-price').innerText = total.toLocaleString() + ' VND';
}

function animateCartIcon() {
    const cartIcon = document.getElementById('cart-icon');
    if (!cartIcon) return;
    cartIcon.classList.add('shake-cart');
    setTimeout(() => cartIcon.classList.remove('shake-cart'), 500);
}

function showToast(message) {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.innerText = message;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 2000);
}
