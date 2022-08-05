function hideshowpublish(ctnid){
    var ctnitem = document.getElementById(ctnid);

    if (ctnitem.style.display == "none"){
        ctnitem.style.display = "block";
    }
    else {
        ctnitem.style.display = "none";
    }
}