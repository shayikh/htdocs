let pwd = document.querySelector('.pwd');
let icon = document.querySelector('.icon');




function showPwd(){
    if(pwd.type == 'password'){
        console.log('password');
        pwd.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
    else if (pwd.type == 'text'){
        console.log('text');
        pwd.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
};






















