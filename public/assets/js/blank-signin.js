
const removeClassName = (elementId, className) => {
    let element = document.getElementById(elementId);
    element.classList.remove(className);
}

const validateLoginForm = () => {
    let errorHas    = 0;
    let username    = document.forms.signinForm.signinUsername.value;
    let password    = document.forms.signinForm.signinPassword.value;  
    let rememberme  = document.forms.signinForm.signinRememberMe.value;

    if (username == null || username == "" || username.length <= 0) {
        removeClassName('err-username', 'd-none')
        errorHas += 1;
    }

    if (password.length < 8) {
        removeClassName('err-password', 'd-none')
        errorHas += 1;
    }
    
    if(errorHas <= 0) 
    {
        axios({
            method: 'post',
            url: '/process/checkUsername',
            data: { username: username }
        })
        .then(function (response) {
            response.data.pipe(fs.createWriteStream('ada_lovelace.jpg'))
        });
      //  alert('aaaaa')
    //     Swal.fire({
    //                 title: 'Oops...',
    //                 html: errorTxt,
    //             });
    //     return false;
    // }
    // else {
    //     if(rememberme == "YES") {
    //         let userLogin = {username: username, password: password}
    //         window.localStorage.removeItem('userLogin');
    //         window.localStorage.setItem('userLogin', JSON.stringify(userLogin));
    //     }

        return false;
    }
    else return false;
}
