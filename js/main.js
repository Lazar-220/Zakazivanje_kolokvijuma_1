document.getElementById('dodajForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch('handler/add.php', {
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        if (text.trim() === "Success") {
            alert("Kolokvijum je zakazan");
            location.reload();
        } else {
            console.log("Error: " + text);
        }

    } catch (error) {
        console.error("Fetch error: ", error);
    }
});

//home.php -> main.js -> add.php -> prijava.php -> add.php -> main.js -> home.php
//submit-zakazi -> fetch -> add,status -> add -> success -> alert,reload -> home.php

document.getElementById('prijavaForm').addEventListener("submit",async function(e){
    e.preventDefault();

    const formData = new FormData(this);
    try {
        const response = await fetch('handler/delete.php', {
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        if (text.trim() === "Success") {
            alert("Kolokvijum je obrisan");
            location.reload();
        } else {
            console.log("Error: " + text);
        }

    } catch (error) {
        console.error("Fetch error: ", error);
    }
});



document.getElementById('izmeniForm').addEventListener("submit", async function(e){
    e.preventDefault();

    const formData=new FormData(this);

    try {
        
        const response= await fetch('handler/update.php',{
            method: 'POST',
            body: formData
        });

        const text= await response.text();
        if(text.trim()==="Success"){
            alert("Kolokvijum je azuriran");
            location.reload();
        }else{
            console.log("Error: "+text);
        }

    } catch (error) {
        console.error("Fetch error: "+error);
    }
});
