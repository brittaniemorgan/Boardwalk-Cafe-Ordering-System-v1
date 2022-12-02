window.onload = function(){

    function cancelOrder(e){
        var orderId = e.target.getAttribute("id");
        let request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if (request.readyState === XMLHttpRequest.DONE){
                if (request.status === 200){
                    console.log("del");
                   // document.getElementById("order-"+orderId).innerHTML = "Order Cancelled";
                }
            }
        }
        request.open("GET", "http://localhost/comp2140-project/prevOrders.php?orderId=" + orderId);
        request.send();   
    }

    console.log("live");
    var deliveryButtons = document.getElementsByClassName("cancel-order-btn");
    for (var i = 0; i < deliveryButtons.length ; i++){
        deliveryButtons[i].addEventListener("click", cancelOrder);
    }
}