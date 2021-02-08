let inputTimeout;

window.addEventListener("load",function(){
    const folderButton = document.querySelector(".menu__folders");
    folderButton.addEventListener("click", function(){
        document.querySelector(".folderSideBar__section").classList.toggle("folderSideBar__section--unfold");
    })

    const actionButton = document.querySelector(".menu__actions");
    actionButton.addEventListener("click", function(){
        document.querySelector(".actionSideBar__section").classList.toggle("actionSideBar__section--unfold");
    })

    const navListItems = document.querySelectorAll(".folderList__li");
    navListItems.forEach(navListItem => {
        navListItem.querySelector(".folderList__button").addEventListener("click", function(event) {
            const innerList = navListItem.querySelector(".folderList__ul");
            if(innerList) {
                innerList.classList.toggle('hidden')
            }
        })
    })

    const searchInput = document.querySelector("#searchBar");
    searchInput.addEventListener("input", function() {
        clearTimeout(inputTimeout)
        inputTimeout = setTimeout(() => this.parentElement.submit(), 600)
    })

    const actionUpload = document.querySelector("#upload");
    actionUpload.addEventListener("click", function(){
        document.querySelector(".modal__section").classList.toggle("hidden");
        document.querySelector(".upload").classList.toggle("hidden");
    })

    const actionNewFolder = document.querySelector("#newFolder");
    actionNewFolder.addEventListener("click", function(){
        document.querySelector(".modal__section").classList.toggle("hidden");
        document.querySelector(".newFolder").classList.toggle("hidden");
    })
});


