/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function clicMenu() {
    var contentRigth = document.getElementById("content-rigth");
    var contentMain = document.getElementById("content-main");
    if (contentRigth.style.display == "none") {
        contentRigth.style.display = "block";
        contentMain.className = "col-sm-9";
    } else {
        contentRigth.style.display = "none"
        contentMain.className = "col-sm-12";
    }

}