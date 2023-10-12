function validationInfo(){
    let pidup = document.getElementById("pidup").value;
    let pnameup = document.getElementById("pnameup").value;
    let priceup = document.getElementById("priceup").value;
    let pdetailup = document.getElementById("pdetailup").value;
    let ptypeup = document.getElementById("ptypeup").value;
    let pquan_stockup = document.getElementById("pquan_stockup").value;
    let plikeup = document.getElementById("plikeup").value;
    

    if(pnameup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกชื่อสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(priceup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกราคาสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(pdetailup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกรายละเอียดสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(pquan_stockup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกจำนวนสินค้าในสต็อก',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(plikeup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกความนิยมของสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    request = new XMLHttpRequest();
    request.onreadystatechange = showNotification;

    let url = "include/update_product.php";
    request.open("POST",url); // use method post
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //encodeURIComponent is access to url parameter it's usually in method GET
    let data = "pname=" + encodeURIComponent(pnameup) + "&pdetail=" + encodeURIComponent(pdetailup) +
               "&price=" + encodeURIComponent(priceup) + "&ptype=" + encodeURIComponent(ptypeup) +
               "&plike=" + encodeURIComponent(plikeup) + "&pquan_stock=" + encodeURIComponent(pquan_stockup) +
               "&pid=" + encodeURIComponent(pidup);

    request.send(data); //send url parameter
}

function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        // Update the content of the 'notification' element with the response
        document.getElementById('notification').innerHTML = request.responseText;
    }
    // Check if the response is Updated., then show SweetAlert2
    if(request.responseText.trim() === "Updated."){
        Swal.fire({
            icon:'success',
            title: 'สำเร็จ',
            text: 'อัพเดทสินค้าเสร็จสิ้น',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
        });
        return false;
    }
}

window.onload = function(){
    let updateinfoBTN = document.getElementById("product_update")
    updateinfoBTN.onclick = validationInfo;
}