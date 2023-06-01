function confirmDelete(id){
    let question = "Da li ste sigurni da želite da izbrišete državu?";
    let userConfirmed = confirm(question);

    if(userConfirmed){
        window.location = `./delete.php?id=${id}`;
    }
}