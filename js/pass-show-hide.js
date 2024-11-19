const pswrdField = document.querySelector(".form input[type='password']");
const toggleIcon = document.querySelector(".form .field i");

toggleIcon.onclick = ()=> {
    //if the password is in its **** format change it to text and vice versa
    if(pswrdField.type === "password")
    {
        pswrdField.type = "text";
        toggleIcon.classList.add("active");
    }
    else
    {
        pswrdField.type = "password";
        toggleIcon.classList.remove("active");
    }
}