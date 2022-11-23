
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
    let inNameEN  = document.getElementById("inSgroupsNameEN").value;
    let inNameTH  = document.getElementById("inSgroupsNameTH").value; 

    if (inNameEN == "" || inNameEN.length< 3 || regxTestAZ09.test(inNameEN) || regxTestOnlyDigits.test(inNameEN)) {
        document.getElementById("errNameEN").classList.remove("d-none");
        errNum += 1;
    }

    if (inNameTH == "" || inNameTH.length< 3 || regxTestAZ09.test(inNameTH) || regxTestOnlyDigits.test(inNameTH)) {
        document.getElementById("errNameTH").classList.remove("d-none");
        errNum += 1;
    }

    if (errNum > 0)     return false;
    else                return true;
    
    return false; 
}
