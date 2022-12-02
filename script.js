window.onload = function(){
    var orderList;
    class RequestManager{
        constructor(){}
        
        sendData(url){
            let request = new XMLHttpRequest();
            request.onreadystatechange = function(){
            if (request.readyState === XMLHttpRequest.DONE){
                if (request.status === 200){
                    document.querySelector("#item-description").innerHTML = request.responseText;
                }}
            }
            request.open("GET", url);
            request.send(); 
            
        }

        sendUpdate(url,orderId,action){
            let request = new XMLHttpRequest();
            request.onreadystatechange = function(){
            if (request.readyState === XMLHttpRequest.DONE){
                if (request.status === 200){
                    if (action=="ready"){
                        document.querySelector("#orderDiv"+orderId).style.display="none";
                    }
                    if (action=="prep"){
                        document.querySelector("#order-status-"+orderId).innerHTML = "Status: PREP";
                    }
                }}
            }
            request.open("GET", url);
            request.send();   
        }

        getFoodDetails(foodID){
            var url = "http://localhost/comp2140-project/foodDescription.php?foodID=" + foodID;
            this.sendData(url);
        }

        getOrders(){
            let request = new XMLHttpRequest();
            request.onreadystatechange = function(){
            if (request.readyState === XMLHttpRequest.DONE){
                if (request.status === 200){
                    document.querySelector("#orders-display").innerHTML = request.responseText;
                }}
            }
            request.open("GET", "http://localhost/comp2140-project/Server.php");
            request.send();  
        }

        getDeliveryAddress(){
            let request = new XMLHttpRequest();
            request.onreadystatechange = function(){
            if (request.readyState === XMLHttpRequest.DONE){
                if (request.status === 200){
                    document.querySelector("#deliveryAddress-display").innerHTML = request.responseText;
                }}
            }
            request.open("GET", "http://localhost/comp2140-project/deliveryPersonnel.php");
            request.send();  
        }
        
    }
    var reqManager = new RequestManager();

    function openPopUp(e) {
        var btn = e.target;
        var foodID = btn.getAttribute("itemid");
        reqManager.getFoodDetails(foodID);
        var overlay = document.querySelector("#overLay");
        overlay.style.display = "block";
    }

    function closePopUp(){
        var overlay = document.querySelector("#overLay");
        overlay.style.display = "none";
    }

    function updateOrderReady(e){
        var btn = e.target;
        var orderId = btn.getAttribute("id");
        console.log(orderId);
        reqManager.sendUpdate("http://localhost/comp2140-project/Server.php?action=updateReady&orderId=" + orderId, orderId,"ready");
    }

    function updateOrderPreparing(e){
        var btn = e.target;
        var orderId = btn.getAttribute("id");
        console.log(orderId);
        reqManager.sendUpdate("http://localhost/comp2140-project/Server.php?action=updatePrepare&orderId=" + orderId, orderId,"prep");
    }

    var foodButtons = document.getElementsByClassName("addToOrderButton");
    for (var i = 0; i < foodButtons.length ; i++){
        foodButtons[i].addEventListener("click",openPopUp);
    }
    //document.querySelector("#close-btn").addEventListener("click", closePopUp);
    //reqManager.getOrders();

    var readyButtons = document.getElementsByClassName("mark-ready");
    for (var i = 0; i < readyButtons.length ; i++){
        readyButtons[i].addEventListener("click", updateOrderReady);
    }

    var prepareButtons = document.getElementsByClassName("mark-preparing");
    for (var i = 0; i < readyButtons.length ; i++){
        prepareButtons[i].addEventListener("click", updateOrderPreparing);
    }

    /* Open when someone clicks on the span element */
    function openNav() {
        console.log("okay");
        document.getElementById("myNav").style.width = "100%";
    }
  
  /* Close when someone clicks on the "x" symbol inside the overlay */
    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }

    document.getElementById("expandBtn").addEventListener("click", openNav);
    document.getElementById("close-menu-btn").addEventListener("click", closeNav);

    
}