let messageSucces = document.getElementById("messageSucces");


if (!sessionStorage.getItem("messageShown")) {
  function showMessage() {
    messageSucces.classList.add("show");


    setTimeout(() => {
      messageSucces.classList.remove("show");
      messageSucces.classList.add("hide");
    }, 2000);


    sessionStorage.setItem("messageShown", "true");
  }


  showMessage();
} else {

  messageSucces.style.display = "none";
}






const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", function () {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);


  this.classList.toggle("fa-eye");
  this.classList.toggle("fa-eye-slash");
});
