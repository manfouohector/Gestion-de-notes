const bars = document.getElementById("dashbars");
const aside = document.getElementById("dashaside");
const span = document.getElementsByClassName("Inverse");
const icon = document.getElementsByClassName("icon");
const icon_admin = document.getElementById("iconadmin");
bars.addEventListener("click",()=>{
    aside.classList.toggle("reduce");
    icon_admin.classList.toggle("iconreduce");
    for(let i = 0; i < span.length; i++) {
        span[i].classList.toggle("inverse");
    }
    for(let i = 0; i < icon.length; i++) {
        icon[i].classList.toggle("ic");
    }
})

const searchbars = document.getElementById("seachbars");
const search = document.getElementById("search");
search.addEventListener("click",()=>{
    searchbars.classList.toggle("visi");
})

const bars2 = document.getElementById("dashbars2");
bars2.addEventListener("click",()=>{
    aside.classList.toggle("voir")
})
