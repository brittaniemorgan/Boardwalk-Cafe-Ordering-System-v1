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
        delivdict = {}; //dict of delivery personnel
        for (i of delivdict){
            if (delivdict[i] = ""){
                delivdict[i] = order;
            }
        }
            
                
    }

    saveOrder(){
        saveOrderBtn = document.getElementById("button-checkout");
        saveOrderBtn.addEventListener("click", function(){
            orderitem1 = document.getElementById("").value;
            quantity1 = document.getElementById("").value;

            orderitem2 = document.getElementById("").value;
            quantity2 = document.getElementById("").value;

            const orderlst = [orderitem1,orderitem2];

            newOrder = new Order(orderlst,address);

            //INSERT INTO table1 (column1, column2,...) VALUES (value1, value2,...);
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