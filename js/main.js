setTimeout(function(){
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
        navListItem.querySelector(".folderList--title").addEventListener("click", function() {
            document.querySelector(".folderSideBar__section").classList.toggle("folderSideBar__section--unfold");
            //Update main content
        })
    })
},0);


