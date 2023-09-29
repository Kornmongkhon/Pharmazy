$(document).ready(function(){//use jquery
    $("#showPass a").on('click',function(e){//ref id $showPass -> a
        e.preventDefault();//stop refresh page
        if($('#showPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
            $('#showPass input').attr('type','password');
            $('#showPass i').addClass(" fa-eye-slash");
            $('#showPass i').removeClass(" fa-e fa-eye");
        }else if($('#showPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
            $('#showPass input').attr('type','text');
            $('#showPass i').removeClass(" fa-eye-slash");
            $('#showPass i').addClass(" fa-e fa-eye");
        }
    })
    $('#showPass i').hide(); //ref id #showPass -> i hide icon
    $('#u_password').on('input',function () {//show icon when input field not empty
        if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
            $('#showPass i').show();
        }else{
            $('#showPass i').hide();
        }
    });
    $("#showConfirmPass a").on('click',function(e){//ref id $showPass -> a
        e.preventDefault();//stop refresh page
        if($('#showConfirmPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
            $('#showConfirmPass input').attr('type','password');
            $('#showConfirmPass i').addClass(" fa-eye-slash");
            $('#showConfirmPass i').removeClass(" fa-e fa-eye");
        }else if($('#showConfirmPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
            $('#showConfirmPass input').attr('type','text');
            $('#showConfirmPass i').removeClass(" fa-eye-slash");
            $('#showConfirmPass i').addClass(" fa-e fa-eye");
        }
    })
    $('#showConfirmPass i').hide(); //ref id #showPass -> i hide icon
    $('#c_password').on('input',function () {//show icon when input field not empty
        if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
            $('#showConfirmPass i').show();
        }else{
            $('#showConfirmPass i').hide();
        }
    });
})
function validation(){
    let fullName = document.getElementById("u_name").value;
    let username = document.getElementById("u_username").value;
    let email = document.getElementById("email").value;
    let address = document.getElementById("address").value;
    let phone = document.getElementById("phone").value;
    let password = document.getElementById("u_password").value;
    let confirmPassword = document.getElementById("c_password").value;
    let gender = document.querySelector('input[name="gender"]:checked');
    let fullnameRegex = /^[\wก-๏\s]{4,20}/;
    let usernameRegex = /^[\w]{4,}/;
    let emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    let addressRegex = /^[\wก-๏\s.-]+/;
    let phoneRegex = /^[\d]{3}-[\d]{3}-[\d]{4}$/;
    let passwordRegex = /^[\w]{8,}/;

    if(fullName === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกชื่อ - นามสกุล',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!fullnameRegex.test(fullName)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอก ชื่อ - นามสกุล ให้ตรงเงื่อนไข ต้องเป็น [ก-ฮ,A-Z,a-z,0-9] ตั้งแต่ 4 ตัวอักษร ถึง 20 ตัวอักษร / มีช่องว่างได้',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(username === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกชื่อผู้ใช้',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!usernameRegex.test(username)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกชื่อผู้ใช้ให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 4 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(email === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกอีเมล์',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!emailRegex.test(email)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: "โปรดกรอกอีเมล์ให้ตรงเงื่อนไข ตัวอย่าง : user@email.com",
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true
        });
        return false;
    }
    else if(phone === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกเบอร์โทรศัพท์',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!phoneRegex.test(phone)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกเบอร์โทรศัพท์ให้ตรงเงื่อนไข ตัวอย่าง : 012-345-6789',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(address === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกที่อยู่',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!addressRegex.test(address)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกที่อยู่ให้ตรงเงื่อนไข ต้องเป็น [ก-ฮ,A-Z,a-z,0-9] ตั้งแต่ 1 ตัวอักษรขึ้นไป / มีช่องว่างได้',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(password === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่าน',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!passwordRegex.test(password)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่านให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 8 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(confirmPassword === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่านยืนยัน',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(password != confirmPassword){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'กรอกรหัสผ่านไม่ตรงกัน',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!gender){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดระบุเพศ',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    return true;
}
window.onload = function(){
    let regBTN = document.getElementById("signup")
    regBTN.onclick = validation;
}