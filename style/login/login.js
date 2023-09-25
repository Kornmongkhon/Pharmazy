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
})

function validation(){
    let username = document.getElementById("u_username").value;
    let password = document.getElementById("u_password").value;
    let usernameRegex = /^[\w]{4,}/;
    let passwordRegex = /^[\w]{8,}/;

    if(username === ''){
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
    return true;
}
window.onload = function(){
    let logBTN = document.getElementById('signin');
    logBTN.onclick = validation;
}