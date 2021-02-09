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
            if(!this.value) {
                location.reload();
                return;
            }
            var data = new FormData();
            data.append('search', this.value);
            axios.post(`http://localhost/local-file-system-explorer/Templates/search.php`, data, {
                params: {
                    path: this.dataset.path
                },
                headers: { 
                    'Content-Type' : 'multipart/form-data' 
                }
            })
            .then(response => {
                const fragment = document.createElement('div');
                fragment.innerHTML = response.data;        
                const $resultsSection = document.querySelector(".results__section");
                $resultsSection.innerHTML = '';
                $resultsSection.appendChild(fragment)
                console.log(response.data);
            })
        }, 600)
    })

    const actionUpload = document.querySelector("#upload");
    actionUpload.addEventListener("click", function(){
        document.querySelector(".modal__section").classList.toggle("hidden");
        if(document.querySelector(".upload").classList.contains("toggle")){
            document.querySelector(".upload").classList.toggle("hidden");
        }

        const modalUpload = document.querySelector(".modal__section");
        modalUpload.addEventListener("click", function(e){
            if(e.target.className == "modal__section"){
                modalUpload.classList.toggle("hidden");
                document.querySelector(".upload").classList.toggle("hidden");
            }
        })

    })

    const actionNewFolder = document.querySelector("#newFolder");
    actionNewFolder.addEventListener("click", function(){
        document.querySelector(".modal__section").classList.toggle("hidden");
        if(document.querySelector(".newFolder").classList.contains("toggle")){
            document.querySelector(".newFolder").classList.toggle("hidden");
        }

        const modalFolder = document.querySelector(".modal__section");
        modalFolder.addEventListener("click", function(e){
            if(e.target.className == "modal__section"){
                modalFolder.classList.toggle("hidden");
                document.querySelector(".newFolder").classList.toggle("hidden")
            }
        })
    })

    const modalInfo = document.querySelector(".modalInfo__section");
    modalInfo.addEventListener("click", function(e){
        if(e.target.className == "modalInfo__section"){
            modalInfo.classList.toggle("hidden");
            modalInfo.children[0].classList.toggle("hidden")
        }
    })
});

function unfoldInnerList(parentList) {
    const innerList = parentList.querySelector(".folderList__ul");
    innerList.classList.toggle('hidden');
    if(innerList.classList.contains('hidden')) {
        return;
    }
    axios.get(`http://localhost/local-file-system-explorer/Templates/folders.php`, {
        params: {
            path: this.dataset.path,
            upLevel: false
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

function showFileInfoModal(type, jsonObject){
    let container="";
    document.querySelector(".modalInfo__section").classList.toggle("hidden");
    switch(type){
        case "audio":
            container.innerHTML = "";
            container = document.querySelector(".modalInfo__audio");
            let audioTitle = document.createElement("p")
            audioTitle.innerText=jsonObject.name;
            let audio = document.createElement("audio");
            audio.controls = "controls";
            audio.src = "./"+(jsonObject.path.replaceAll("+", " "));
            audio.type = jsonObject.mimeType;
            container.appendChild(audioTitle);
            container.appendChild(audio);
            container.classList.toggle("hidden");
            break;
        case "video":
            container.innerHTML = "";
            container = document.querySelector(".modalInfo__video");
            let videoTitle = document.createElement("p")
            videoTitle.innerText=jsonObject.name;
            let video = document.createElement("video");
            video.controls = "controls";
            video.src = "./"+(jsonObject.path.replaceAll("+", " "));
            video.type = jsonObject.mimeType;
            container.appendChild(videoTitle);
            container.appendChild(video);
            container.classList.toggle("hidden");
            break;
        case "image":
            container.innerHTML = "";
            container = document.querySelector(".modalInfo__image");
            let imageTitle = document.createElement("p")
            imageTitle.innerText=jsonObject.name;
            let image = document.createElement("img");
            image.src = "./"+(jsonObject.path.replaceAll("+", " "));
            image.alt = jsonObject.name;
            container.appendChild(imageTitle);
            container.appendChild(image);
            container.classList.toggle("hidden");
            break;
    }
}



