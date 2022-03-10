'use strict'
let cart = [];

window.addEventListener("DOMContentLoaded", () => {
    document.getElementById('nombre-produit' ).innerHTML = cart.length.toString();

    let listeBouton = document.getElementsByClassName('btn btn-outline-dark mt-auto');
    for(let i=0;i<listeBouton.length;i++){
        listeBouton.item(i).addEventListener("click", function (e) {
            let titre = document.getElementsByClassName("titre").item(i);
            let poids = document.getElementsByClassName("poids").item(i);
            cart.push({titre:titre.innerHTML,poids:poids.innerHTML });
            document.getElementById('nombre-produit' ).innerText = cart.length.toString();
            displayCart(cart);
        });
    }


});

function displayCart(cart){

    let elem = "";
    cart.forEach(obj =>
        elem +=
            `
         ${obj.titre} | poids: ${obj.poids}
         <br>
         `
    );
    let poid = 0;
    cart.forEach(prod => {
        poid += parseFloat(prod.poids);
    });
    if(poid <= 0.7){
        elem += `<br><span> taille boite: petite boite </span><br>`
    }else if(poid <= 1.5){
        elem += `<br><span> taille boite: moyenne boite </span><br>`
    }else if(poid <= 3.2){
        elem += `<br><span> taille boite: grande boite </span><br>`
    }else{
        elem += `<br><span> taille boite: Trop lourd enlevez des produits</span><br>`
    }
    poid = poid.toFixed(2);
    elem += `<br><strong><span>poids total: ${poid}&emsp;</span> <button id='commander' class="btn btn-outline-dark" type="submit">Commander</button></strong>`;

    document.getElementById('contenu-panier').innerHTML = elem;

}