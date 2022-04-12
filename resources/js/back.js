//eliminazione dalla pagina
window.btnDelete= btnDelete;

//funzione dalla quale ricavo l'id e la rotta poi lo passo nell'action del form dell'index
function btnDelete(id,route){
  document.getElementById("myForm").action = route + "/" + id;
}