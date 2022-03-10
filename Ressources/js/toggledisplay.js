window.addEventListener("DOMContentLoaded",()=>{
    let btnAt = document.getElementById('ate');
    btnAt.addEventListener('click',toggle);

    }
);


let affiche = false;
function toggle(){
    let aff = document.getElementById('toggle');
    if(!affiche){
        aff.style.display = "block";
        affiche = true;
        console.log("affiche");
    }else{
        aff.style.display = "none";
        affiche = false;
        console.log("afficge pas")
    }
}
