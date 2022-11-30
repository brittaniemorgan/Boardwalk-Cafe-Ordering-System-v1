import {Order} from './Order.js';

class OrderProcessor {

    constructor(orderlist) {  // Constructor
      this.orderlist = orderlist;
      
    }

    organizeDeliveryLocation(listoforders){
        function compare(order1,order2) {
            if (order1.address < order2.address)
               return -1;
            if (order1.address > order2.address)
              return 1;
            return 0;
          }
          

        //sort list of deliveries
        //delivlist = 

        delivlist.sort(compare);
        
    }

    assignDeliveries(order){
        //add the order to the dictionary of deliveries
        delivdict = {}; //dict of delivery pesonell
        for (i of delivdict){
            if (delivdict[i] = ""){
                delivdict[i] = order;
            }
        }
            
                
    }




   
    orderlst = [];

    saveOrder(){
        saveOrderBtn = document.getElementById("addToCart");
        saveOrderBtn.addEventListener("click", function(){
            orderitem1 = document.getElementById("order").value;

            orderlst = orderlst +[orderitem1]


            
             


            // orderitem2 = document.getElementById("").value;
            // quantity2 = document.getElementById("").value;

            newOrder = new Order(orderlst,address);
            //INSERT INTO table1 (column1, column2,...) VALUES (value1, value2,...);
        });
    }

    viewCart(){
        viewCartBtn = document.getElementById("addToCart");
        viwCartBtn.addEventListener("click", function(){
            let itemdisplay = document.getElementsByClassName("items").value;

            let items = itemdisplay[0];
            items.innerHTML = orderlst;


            
        });
    }

    removeOrder(orderlist){
        removeOrderBtn.addEventListener("click", function(){
            orderitem = document.getElementById("").value;
        });
        for (var i = 0; i < orderlist.length; i++){
            if (orderitem.orderNum == orderlist.orderNum){
                orderlist.splice(i, 1);
            }
        }

    }

  }