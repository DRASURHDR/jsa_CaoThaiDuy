// Dropdown menu & mega menu
document.querySelectorAll('.dropdown > a').forEach(e => {
    if (e) {
        e.addEventListener('click', (event) => event.preventDefault())
    }
})
document.querySelectorAll('.mega-dropdown > a').forEach(e => {
    if (e) {
        e.addEventListener('click', (event) => event.preventDefault())
    }
})

const mbMenuToggle = document.querySelector('#mb-menu-toggle');
if (mbMenuToggle) {
    mbMenuToggle.addEventListener('click', () => {
        const headerWrapper = document.querySelector('#header-wrapper');
        if (headerWrapper) headerWrapper.classList.add('active');
    });
}

const mbMenuClose = document.querySelector('#mb-menu-close');
if (mbMenuClose) {
    mbMenuClose.addEventListener('click', () => {
        const headerWrapper = document.querySelector('#header-wrapper');
        if (headerWrapper) headerWrapper.classList.remove('active');
    });
}

// Admin Product Page Logic
let currentTarget = '';

function openMedia(target) {
    currentTarget = target;
    const mediaUrl = '/nolapnolife/media-library/?target=' + target;
    window.open(mediaUrl, 'Select Image', 'width=800,height=600');
}

function selectImageFromLibrary(url) {
    const mainInput = document.querySelector('input[name="main_image"]');
    const additionalInput = document.getElementById('additional_images');
    const previewContainer = document.getElementById('additional-preview');

    if (currentTarget === 'main') {
        if (mainInput) {
            mainInput.value = url;
        }
    } else if (currentTarget === 'additional') {
        if (!additionalInput || !previewContainer) return;

        if (url === '') {
            additionalInput.value = '[]';
            previewContainer.innerHTML = '';
        } else {
            let images = additionalInput.value ? JSON.parse(additionalInput.value) : [];
            images.push(url);
            additionalInput.value = JSON.stringify(images);
            renderAdditionalPreview();
        }
    }
}

// Hiển thị lại các ảnh phụ
function renderAdditionalPreview() {
    const additionalInput = document.getElementById('additional_images');
    const previewContainer = document.getElementById('additional-preview');
    if (!additionalInput || !previewContainer) return;

    previewContainer.innerHTML = '';

    if (!additionalInput.value) return;

    let images = [];
    try {
        images = JSON.parse(additionalInput.value);
    } catch (error) {
        console.error('Error parsing additional_images JSON:', error);
        return;
    }

    images.forEach((imgUrl, index) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'preview-thumb';

        const img = document.createElement('img');
        img.src = imgUrl;
        img.alt = 'Additional Image';

        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'delete-btn';
        deleteBtn.innerHTML = '&times;';
        deleteBtn.onclick = function () {
            images.splice(index, 1);
            additionalInput.value = JSON.stringify(images);
            renderAdditionalPreview();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(deleteBtn);
        previewContainer.appendChild(wrapper);
    });
}

// Confirm delete product
document.querySelectorAll('.admin-btn.delete').forEach(button => {
    if (button) {
        button.addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to delete this product?')) {
                e.preventDefault();
            }
        });
    }
});

// Khi load trang -> nếu có ảnh phụ cũ -> render
document.addEventListener('DOMContentLoaded', () => {
    renderAdditionalPreview();
});