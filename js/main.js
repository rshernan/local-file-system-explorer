setTimeout(function(){
    document.querySelectorAll(".folderList__li").forEach(function(item){
        item.addEventListener("click", function(){
            Array.from(item.children).forEach(function(child){
                child.style.paddingLeft = (parseInt(item.style.paddingLeft.match(/[0-9]/g))+5)+"px";
                item.parentNode.insertBefore(child, item.nextSibling);
                child.classList.remove("folderList__li--hidden");
            })
        });
    })

    const folderButton = document.querySelector(".menu__folders");
    console.log(folderButton);
    folderButton.addEventListener("click", function(){
        document.querySelector(".folderSideBar__section").classList.toggle("folderSideBar__section--unfold");
    })
},0);


