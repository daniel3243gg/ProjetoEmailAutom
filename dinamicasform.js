function verificarCookies() {

    if (document.cookie.includes("login")) {
       
        window.location.href = "form.php";
    }

    console.log('entrei 23')

}


verificarCookies();