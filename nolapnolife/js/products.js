// // let products = [
// //     {
// //         name: 'Alienware M17 R5',
// //         image1: './images/JBL_E55BT_KEY_BLACK_6175_FS_x1-1605x1605px.png',
// //         image2: './images/JBL_LIVE650BTNC_Product Image_Folded_Black.webp',
// //         old_price: '2500',
// //         curr_price: '2200'
// //     },
// //     {
// //         name: 'Alienware X16 R2',
// //         image1: './images/JBL_JR 310BT_Product Image_Hero_Skyblue.png',
// //         image2: './images/JBL_JR 310BT_Product Image_Detail_Skyblue.png',
// //         old_price: '2700',
// //         curr_price: '2400'
// //     },
// //     {
// //         name: 'ASUS ROG Strix G17',
// //         image1: './images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png',
// //         image2: './images/JBL_E55BT_KEY_RED_6063_FS_x1-1605x1605px.webp',
// //         old_price: '2100',
// //         curr_price: '1850'
// //     },
// //     {
// //         name: 'Predator Helios 300',
// //         image1: './images/JBLHorizon_001_dvHAMaster.png',
// //         image2: './images/JBLHorizon_BLK_002_dvHAMaster.webp',
// //         old_price: '2000',
// //         curr_price: '1700'
// //     },
// //     {
// //         name: 'Predator Raider PH16',
// //         image1: './images/JBL_TUNE220TWS_ProductImage_Pink_ChargingCaseOpen.png',
// //         image2: './images/JBL_TUNE220TWS_ProductImage_Pink_Back.png',
// //         old_price: '2300',
// //         curr_price: '2000'
// //     },
// //     {
// //         name: 'MSI GE76 Raider',
// //         image1: './images/190402_E1_FW19_EarbudsWCase_S13_0033-1_1605x1605_HERO.png',
// //         image2: './images/190402_E1_FW19_EarbudsWCase_S13_0033-1_1605x1605_BACK.png',
// //         old_price: '2800',
// //         curr_price: '2500'
// //     },
// //     {
// //         name: 'MSI Raider GE68 HX',
// //         image1: './images/JBL_Endurance-SPRINT_Product-Image_Red_front-1605x1605px.webp',
// //         image2: './images/JBL-Endurance-Sprint_Alt_Red-1605x1605px.webp',
// //         old_price: '2600',
// //         curr_price: '2300'
// //     },
// // ]

// let product_list = document.querySelector('#products');

// renderProducts = (products) => {
//     products.forEach(e => {
//         // Lấy main image
//         const mainImage = e.main_image;

//         // Lấy ảnh phụ thứ 1 từ additional_images (nếu có)
//         let additionalImages = [];
//         try {
//             additionalImages = JSON.parse(e.additional_images);
//         } catch (error) {
//             console.error('Lỗi parse additional_images:', error);
//         }
//         const hoverImage = additionalImages.length > 0 ? additionalImages[0] : mainImage; // nếu không có thì dùng lại ảnh chính

//         let prod = `
//             <div class="col-4 col-md-6 col-sm-12">
//                 <div class="product-card">
//                     <div class="product-card-img">
//                         <img src="${mainImage}" alt="">
//                         <img src="${hoverImage}" alt="">
//                     </div>
//                     <div class="product-card-info">
//                         <div class="product-btn">
//                             <a href="./product-detail.html" class="btn-flat btn-hover btn-shop-now">shop now</a>
//                             <button class="btn-flat btn-hover btn-cart-add">
//                                 <i class='bx bxs-cart-add'></i>
//                             </button>
//                             <button class="btn-flat btn-hover btn-cart-add">
//                                 <i class='bx bxs-heart'></i>
//                             </button>
//                         </div>
//                         <div class="product-card-name">
//                             ${e.name}
//                         </div>
//                         <div class="product-card-price">
//                             <span><del>${e.old_price}</del></span>
//                             <span class="curr-price">${e.curr_price}</span>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;
//         product_list.insertAdjacentHTML("beforeend", prod);
//     });
// };


// // renderProducts(products)
// // renderProducts(products)

// let filter_col = document.querySelector('#filter-col')

// document.querySelector('#filter-toggle').addEventListener('click', () => filter_col.classList.toggle('active'))

// document.querySelector('#filter-close').addEventListener('click', () => filter_col.classList.toggle('active'))

const productItems = document.querySelectorAll('#products .col-4'); 
const itemsPerPage = 9;
const totalPages = Math.ceil(productItems.length / itemsPerPage);

const paginationContainer = document.querySelector('.pagination');

function generatePagination() {
    paginationContainer.innerHTML = '';

    // Nút về đầu
    const first = `<li><a href="#" id="first-page"><i class='bx bxs-chevron-left'></i></a></li>`;
    paginationContainer.insertAdjacentHTML('beforeend', first);

    // Các trang
    for (let i = 1; i <= totalPages; i++) {
        paginationContainer.insertAdjacentHTML('beforeend', `
            <li><a href="#" class="page-link ${i === 1 ? 'active' : ''}" data-page="${i}">${i}</a></li>
        `);
    }

    // Nút về cuối
    const last = `<li><a href="#" id="last-page"><i class='bx bxs-chevron-right'></i></a></li>`;
    paginationContainer.insertAdjacentHTML('beforeend', last);
}

generatePagination();

function showPage(page) {
    productItems.forEach((item, index) => {
        if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

showPage(1); // Ban đầu load trang 1

paginationContainer.addEventListener('click', (e) => {
    e.preventDefault();
    if (e.target.tagName === 'A') {
        let page = e.target.dataset.page;

        if (e.target.id === 'first-page') {
            page = 1;
        } else if (e.target.id === 'last-page') {
            page = totalPages;
        }

        if (page) {
            document.querySelectorAll('.page-link').forEach(link => link.classList.remove('active'));
            const activeLink = document.querySelector(`.page-link[data-page="${page}"]`);
            if (activeLink) activeLink.classList.add('active');

            showPage(parseInt(page));
        }
    }
});



