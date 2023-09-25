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
            title: 'Warning!',
            text: 'Please enter your full name.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!fullnameRegex.test(fullName)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your Full Name in regex [ก-ฮ,A-Z,a-z,0-9] 4 - 20 characters and can be whitespace.',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(username === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your username.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!usernameRegex.test(username)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your username in regex [A-Z,a-z,0-9] 4 or more characters and can be whitespace.',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(email === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your email.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!emailRegex.test(email)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: "Please enter a valid Email in regex example : user@email.com, it's can be [A-Z,a-z,0-9] 1 or more characters",
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true
        });
        return false;
    }
    else if(phone === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your phone.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!phoneRegex.test(phone)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your phone number in regex example : 012-345-6789',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(address === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your address.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!addressRegex.test(address)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your address in regex must be 4 or more characters with any characters.',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(password === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your password.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!passwordRegex.test(password)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your password in regex [A-Z,a-z,0-9] must be 8 or more characters.',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(confirmPassword === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your confirm password.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(password != confirmPassword){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Password not match.',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!gender){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your gender.',
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