// discography.php js

const searchInput = document.getElementById("album-search");
if(searchInput)
{
    searchInput.addEventListener("input", function()
    {
        const searchValue = this.value.toLowerCase();
        const albums = document.querySelectorAll(".album-card");
        albums.forEach(album =>
        {
            const albumName = album.querySelector("h3").textContent.toLowerCase();
            if(albumName.includes(searchValue))
            {
                album.style.display = "flex";
            }
            else
            {
                album.style.display = "none";
            }
        });
    });
}

// auth.php js

const loginButton = document.getElementById("show-login");
const registerButton = document.getElementById("show-register");

if(loginButton && registerButton)
{
    loginButton.addEventListener("click", function()
    {
        document.getElementById("login-form").style.display = "block";
        document.getElementById("register-form").style.display = "none";
    });

    registerButton.addEventListener("click", function()
    {
        document.getElementById("login-form").style.display = "none";
        document.getElementById("register-form").style.display = "block";
    });
}
//add input verification here