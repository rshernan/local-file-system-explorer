setTimeout(function(){
    const folderButton = document.querySelector(".menu__folders");
    folderButton.addEventListener("click", function(){
        document.querySelector(".folderSideBar__section").classList.toggle("folderSideBar__section--unfold");
    })

    const actionButton = document.querySelector(".menu__actions");
    actionButton.addEventListener("click", function(){
        document.querySelector(".actionSideBar__section").classList.toggle("actionSideBar__section--unfold");
    })

},0);


