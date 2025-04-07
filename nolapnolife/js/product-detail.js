document.querySelectorAll('.product-img-item').forEach(e => {
    e.addEventListener('click', () => {
        let img = e.querySelector('img').getAttribute('src')
        document.querySelector('#product-img > img').setAttribute('src', img)
    })
})

document.querySelector('#view-all-description').addEventListener('click', () => {
    let content = document.querySelector('.product-detail-description-content')
    content.classList.toggle('active')
    document.querySelector('#view-all-description').innerHTML = content.classList.contains('active') ? 'view less' : 'view all'
})

let products = [
    {
        name: 'Alienware M17 R5',
        image1: '/wp-content/themes/nolapnolife/images/Alienware_M17_R5-inn.png',
        image2: '/wp-content/themes/nolapnolife/images/Alienware_M17_R5-in.png',
        old_price: '2500',
        curr_price: '2200'
    },
    {
        name: 'Alienware X16 R2',
        image1: '/wp-content/themes/nolapnolife/images/Alienware-x16-R2-6-inn.png',
        image2: '/wp-content/themes/nolapnolife/images/alienware-x16-r2-5-29b2a67d-eb59-474d-b890-5363889cefd2.webp',
        old_price: '2700',
        curr_price: '2400'
    },
    {
        name: 'ASUS ROG Strix G17',
        image1: '/wp-content/themes/nolapnolife/images/asus-rog-strix-g17-inn-.png',
        image2: '/wp-content/themes/nolapnolife/images/Rog_strix_g17_in-.png',
        old_price: '2100',
        curr_price: '1850'
    },
    {
        name: 'Predator Helios 300',
        image1: '/wp-content/themes/nolapnolife/images/acer_predator_helios_300_inn.png',
        image2: '/wp-content/themes/nolapnolife/images/predator-helios-300-in.png',
        old_price: '2000',
        curr_price: '1700'
    },
    {
        name: 'Predator Raider PH16',
        image1: '/wp-content/themes/nolapnolife/images/predator-helios-16-ph16-inn.png',
        image2: '/wp-content/themes/nolapnolife/images/predator_helios_16_in.png',
        old_price: '2300',
        curr_price: '2000'
    },
    {
        name: 'MSI GE76 Raider',
        image1: '/wp-content/themes/nolapnolife/images/raider-ge76-inn.png',
        image2: '/wp-content/themes/nolapnolife/images/msi-ge76-raider-2021-in-.png',
        old_price: '2800',
        curr_price: '2500'
    },
    {
        name: 'MSI Raider GE68 HX',
        image1: '/wp-content/themes/nolapnolife/images/Raider 68 HX in.webp',
        image2: '/wp-content/themes/nolapnolife/images/Rader 68 HX inn.png',
        old_price: '2600',
        curr_price: '2300'
    },
];

let product_list = document.querySelector('#related-products')

renderProducts = (products) => {
    products.forEach(e => {
        let prod = `
            <div class="col-4 col-md-6 col-sm-12">
                <div class="product-card">
                    <div class="product-card-img">
                        <img src="${e.image1}" alt="">
                        <img src="${e.image2}" alt="">
                    </div>
                    <div class="product-card-info">
                        <div class="product-btn">
                            <a href="./product-detail.html" class="btn-flat btn-hover btn-shop-now">shop now</a>
                            <button class="btn-flat btn-hover btn-cart-add">
                                <i class='bx bxs-cart-add'></i>
                            </button>
                            <button class="btn-flat btn-hover btn-cart-add">
                                <i class='bx bxs-heart'></i>
                            </button>
                        </div>
                        <div class="product-card-name">
                            ${e.name}
                        </div>
                        <div class="product-card-price">
                            <span><del>${e.old_price}</del></span>
                            <span class="curr-price">${e.curr_price}</span>
                        </div>
                    </div>
                </div>
            </div>
        `
        product_list.insertAdjacentHTML("beforeend", prod)
    })
}

renderProducts(products)