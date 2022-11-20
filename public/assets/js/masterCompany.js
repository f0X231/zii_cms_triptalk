const preview = () => {  document.getElementById("preview-logo").src = URL.createObjectURL(event.target.files[0]); }
const showStatus = (val) => { 
    if(val.checked) { 
        document.getElementById("label-status").innerHTML = "Active";
        val.value = 'Y';
    } 
    else {
        document.getElementById("label-status").innerHTML = "Inactive"; 
        val.value = 'N';
    }
}

const validation = () => {
    let errNum = 0;
    let regxTestEmail = /^[a-z-._0-9]+@[a-z0-9]+\.[a-z.]{2,5}$/;
    let regxTestAZ09 = /\./;        // Find a single character, except newline or line terminator
    let regxTestOnlyDigits = /\d/;  // Only digits find

    // arg is used to pass value
    let inName  = document.getElementById("inCompanyName").value; 
    let inPhone = document.getElementById("inCompanyPhone").value; 
    let inEmail = document.getElementById("inCompanyMail").value; 


    if (inName == "" || inName.length< 3 || regxTestAZ09.test(inName) || regxTestOnlyDigits.test(inName)) {
        document.getElementById("errName").classList.remove("d-none");
        errNum += 1;
    }

    if (inPhone == "" || inPhone.length < 8 || isNaN(inPhone)) {
        document.getElementById("errPhone").classList.remove("d-none");
        errNum += 1;
    }

    if (inEmail == "" || !regxTestEmail.test(inEmail)) {
        document.getElementById("errEmail").classList.remove("d-none");
        errNum += 1;
    }

    /*  If you don't Enter anything in Comment field than show error(Enter Comments) */
    // if (!arg.gender[0].checked && !arg.gender[1].checked) {
    //     errNum++;
    //     err += errNum + ". Select gender.\n";
    // }
    /* If you don't  checked 0 index of gender field  or 1 index than show error(Select gender)*/
    // if (!arg.tv.checked&& !arg.radio.checked) {
    //     errNum++;
    //     err += errNum + ". Select Reference.\n";
    // }
    /*  If you don't  checked tv field and radio field than show error(Select Reference) */
    // if (arg.course.selectedIndex< 1) {
    //     errNum++;
    //     err += errNum + ". Select Course.\n";
    // }
    /* If errNum is less than 0 or 0 than alert "done" and return "true"*/

    if (errNum > 0)     return false;
    else                return true;
    return false; 
}