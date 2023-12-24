function verificarCookies() {

    if (document.cookie.includes("login") && document.cookie.includes("outra_cookie")) {
       
        window.location.href = "form.php";
    }
}


verificarCookies();