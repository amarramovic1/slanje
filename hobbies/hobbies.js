function confirmDelete(id){
    let question = "Da li ste sigurni da želite da izbrišete hobi?";
    let userConfirmed = confirm(question);

    if(userConfirmed){
        window.location = `./delete.php?id=${id}`;
    }
}