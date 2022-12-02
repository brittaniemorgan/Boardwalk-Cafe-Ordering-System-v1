window.onload=function(){
    function sendUpdateDel(url,orderId){
        let request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if (request.readyState === XMLHttpRequest.DONE){
                if (request.status === 200){
                    document.querySelector("#DeliveryDiv-"+orderId).style.display="none";
                }
            }
        }
        request.open("GET", url);
        request.send();   
    }

    function updateDelivery(e){
        var btn = e.target;
        var orderId = btn.getAttribute("id");
        console.log(orderId);
        sendUpdateDel("http://localhost/comp2140-project/deliveryPersonnel.php?orderID=" + orderId, orderId);
    }

    var deliveryButtons = document.getElementsByClassName("delivered-order");
    for (var i = 0; i < deliveryButtons.length ; i++){
        deliveryButtons[i].addEventListener("click", updateDelivery);
    }
}