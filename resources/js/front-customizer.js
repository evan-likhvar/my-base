const logoutButton = document.getElementById("logout-button");

if (logoutButton) {
    logoutButton.addEventListener(
        "click", (event)=>{
            event.preventDefault();
            document.getElementById('auth-logout-form').submit();
        }, false);
}

