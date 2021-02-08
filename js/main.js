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
        navListItem.querySelector(".folderList__button").addEventListener("click", function() {
            unfoldInnerList.call(this, navListItem);
        })
    })

    const searchInput = document.querySelector("#searchBar");
    searchInput.addEventListener("input", function() {
        clearTimeout(inputTimeout)
        inputTimeout = setTimeout(() => {
            var data = new FormData();
            data.append('search', this.value);
            axios.post(`http://localhost/PHPFileSystem/Templates/search.php`, data, {
                params: {
                    path: this.dataset.path
                },
                headers: { 
                    'Content-Type' : 'multipart/form-data' 
                }
            })
            .then(response => {
                console.log(response.data);
            })
        }, 600)
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

function unfoldInnerList(parentList) {
    const innerList = parentList.querySelector(".folderList__ul");    
    innerList.classList.toggle('hidden');
    if(innerList.classList.contains('hidden')) {
        return;
    }
    axios.get(`http://localhost/PHPFileSystem/Templates/folders.php`, {
        params: {
            path: this.dataset.path
        }
    })
    .then(response => {
        const fragment = document.createElement('div');
        fragment.innerHTML = response.data;
        const navListItems = fragment.querySelectorAll(".folderList__li");
        navListItems.forEach(navListItem => {
            navListItem.querySelector(".folderList__button").addEventListener("click", function() {
                unfoldInnerList.call(this, navListItem);
            })
        })
        innerList.innerHTML = '';
        innerList.replaceWith(fragment.querySelector('.folderList__ul'));
    })
}


