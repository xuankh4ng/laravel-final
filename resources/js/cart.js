// Biến lưu trữ form
let formToSubmit = null; 

// Gắn hàm vào window để HTML có thể gọi được (onclick="checkQuantity(...)")
window.checkQuantity = function(btn, quantity) {
    if (quantity > 1) {
        // Nếu số lượng > 1 thì submit form giảm ngay
        btn.closest('form').submit();
    } else {
        // Nếu số lượng = 1 thì hiện Modal
        formToSubmit = btn.closest('form');
        document.getElementById('confirm-delete-modal').classList.remove('hidden');
    }
};

window.closeModal = function() {
    document.getElementById('confirm-delete-modal').classList.add('hidden');
    formToSubmit = null;
};

// Sự kiện khi DOM đã load xong (để gắn sự kiện cho nút Confirm)
document.addEventListener('DOMContentLoaded', () => {
    const confirmBtn = document.getElementById('confirm-btn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if(formToSubmit) {
                formToSubmit.submit();
            }
        });
    }
});