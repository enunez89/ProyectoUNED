/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

localStorage.setItem("idModule",0);
function changeModule(idModule){
    localStorage.setItem("idModule",idModule);
    var id= localStorage.getItem("idModule");
    switch(id) {
    case "0":
        alert(id);
        break;
    case "1":
        alert(id);
        break;
    default:
        //alert(id);
    } 
}

   