/////////////////// Fetch and display products from the server ////////////////////////// 

async function fetchProducts(searchQuery = "") {
    try {
        const url = searchQuery.length > 0
                ? `http://localhost/website/store/api/api.php?search=${encodeURIComponent(searchQuery)}` 
                : `http://localhost/website/store/api/api.php`;

        const response = await fetch(url);
        const products = await response.json();

        const tableBody = document.querySelector("#productTable tbody");
        tableBody.innerHTML = ""; // مسح الجدول قبل تحديث البيانات
        
        products.forEach(product => {
            const row = document.createElement("tr");
            row.setAttribute("data-id", product.id); // حفظ ID المنتج في الصف
            row.innerHTML = `
                <td>${product.id}</td>
                <td class="name">${product.name}</td>
                <td class="price">$${product.price}</td>
                <td class="quantity">${product.quantity}</td>
                <td>
                    <button class="edit-btn" onclick="enableEditMode(this)">Edit</button>
                    <button class="delete-btn" onclick="deleteProduct(${product.id}, this)">Delete</button>
                    </td>
                    `;
                    tableBody.appendChild(row);
        });
    } catch (error) {
        console.error("Error fetching products:", error);
        alert("An error occurred while loading products. Please try again later.");
    }
}

    // استدعاء جلب المنتجات عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", fetchProducts);

    ////////////////////////// Search for product //////////////////////////

function searchProducts() {
    const query = document.getElementById("searchInput").value.trim();
    fetchProducts(query);
}

     /////////////////// update products ////////////////////////// 

function enableEditMode(button) {
    const row = button.closest("tr"); // جلب الصف الذي يحتوي على الزر
    const id = row.getAttribute("data-id");
    
    // تحديد الخلايا القابلة للتعديل
    const nameCell = row.querySelector(".name");
    const priceCell = row.querySelector(".price");
    const quantityCell = row.querySelector(".quantity");

    // حفظ القيم الأصلية لاستعادتها عند الإلغاء
    const originalName = nameCell.textContent;
    const originalPrice = priceCell.textContent.replace("$", ""); // إزالة رمز الدولار
    const originalQuantity = quantityCell.textContent;

    // تحويل القيم إلى مدخلات قابلة للتحرير
    nameCell.innerHTML = `<input type="text" value="${originalName}" class="editable-input">`;
    priceCell.innerHTML = `<input type="number" value="${originalPrice}" class="editable-input">`;
    quantityCell.innerHTML = `<input type="number" value="${originalQuantity}" class="editable-input">`;

    // تغيير زر "Edit" إلى "Save" و "Cancel"
    button.outerHTML = `
        <button class="save-btn" onclick="saveEdit(this, ${id})">Save</button>
        <button class="cancel-btn" onclick="cancelEdit(this, '${originalName}', ${originalPrice}, ${originalQuantity})">Cancel</button>
    `;
}


async function saveEdit(button, id) {
    const row = button.closest("tr");

    // جلب القيم الجديدة
    const name = row.querySelector(".name input").value;
    const price = row.querySelector(".price input").value;
    const quantity = row.querySelector(".quantity input").value;

    try {
        const response = await fetch("http://localhost/website/store/api/api.php", {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, name, price, quantity })
        });

        const result = await response.json();
        
        if (response.ok) {
            // تحديث الصف بالقيم الجديدة
            row.querySelector(".name").innerHTML = name;
            row.querySelector(".price").innerHTML = `$${price}`;
            row.querySelector(".quantity").innerHTML = quantity;

            // إعادة الأزرار إلى وضع "Edit"
            row.querySelector(".save-btn").outerHTML = `<button class="edit-btn" onclick="enableEditMode(this)">Edit</button>`;
            row.querySelector(".cancel-btn").remove();
        } else {
            alert("Failed to update product: " + result.message);
        }
    } catch (error) {
        console.error("Error updating product:", error);
        alert("An error occurred while updating the product. Please try again.");
    }
}


function cancelEdit(button, originalName, originalPrice, originalQuantity) {
    const row = button.closest("tr");

    // إرجاع القيم الأصلية
    row.querySelector(".name").innerHTML = originalName;
    row.querySelector(".price").innerHTML = `$${originalPrice}`;
    row.querySelector(".quantity").innerHTML = originalQuantity;

    // إعادة زر "Edit"
    row.querySelector(".save-btn").outerHTML = `<button class="edit-btn" onclick="enableEditMode(this)">Edit</button>`;
    row.querySelector(".cancel-btn").remove();
}



// تحميل المنتجات عند فتح الصفحة
document.addEventListener("DOMContentLoaded", fetchProducts);


/////////////////////////////////////// add product //////////////////////////////////////////
function addProduct() {
    let name = document.getElementById("productName").value.trim();
    let price = document.getElementById("productPrice").value.trim();
    let count = document.getElementById("productCount").value.trim();
    
    // التحقق من أن جميع الحقول ممتلئة
    if (!name || !price || !count) {
        alert("Please fill in all fields!");
        return;
    }
    
    // التحقق من أن السعر والعدد أرقام صحيحة
    if (isNaN(price) || isNaN(count) || price <= 0 || count <= 0) {
        alert("Please enter a valid price and count!");
        return;
    }

    fetch("http://localhost/website/store/api/api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            name: name,
          price: parseFloat(price),  // تحويل السعر إلى رقم عشري
          quantity: parseInt(count)     // تحويل العدد إلى عدد صحيح
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
      fetchProducts(); // تحديث القائمة بعد الإضافة

      // تفريغ الحقول بعد الإضافة
        document.getElementById("productName").value = "";
        document.getElementById("productPrice").value = "";
        document.getElementById("productCount").value = "";
    })
    .catch(error => console.error("Error adding product:", error));
}


/////////////////////////////////////// Delete product //////////////////////////////////////////


function deleteProduct(id) {

    fetch("http://localhost/website/store/api/api.php", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) { // التحقق من نجاح العملية
            console.log("تم حذف المنتج بنجاح"); // طباعة الرسالة في الـ Console
            fetchProducts(); // تحديث القائمة بعد الحذف
        } else {
            console.error("فشل حذف المنتج:", data.message);
        }
    })
    .catch(error => console.error("Error deleting product:", error));
}





