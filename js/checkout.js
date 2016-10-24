
function checkacc(msg){
   
  if ($('#acceptBox').attr('checked')) {
        return true;
    } else {
        alert(msg);
        return false;
    }
}
