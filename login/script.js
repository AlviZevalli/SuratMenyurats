document.getElementById("login-form").addEventListener("submit", function(event) {
  event.preventDefault();

  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var errorMessage = document.getElementById("error-message");

  if (username === "user" && password === "password") {
    errorMessage.textContent = "Login berhasil!";
    errorMessage.style.color = "green";
    window.location.href = "/";
  } else {
    errorMessage.textContent = "Username atau password salah. Silakan coba lagi.";
    errorMessage.style.color = "red";
  }
});
