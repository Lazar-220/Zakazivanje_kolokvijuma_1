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
