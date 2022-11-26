import {MenuIitem} from './MenuItem';

export class Order {

    ordernum = 1;

    constructor(menuitemslst, address) {  // Constructor
        this.orderNum = ordernum;
        this.address = address;
        this.status = "Pending";
        this.menuitems = menuitemslst;
        ordernum = ordernum + 1;

      
    }

    getAddress(){
        return this.address;
    }
    
    getStatus(){
        return this.status;
    }

    getMenuItems(){
        return this.menuitems;
    }

    calculatePrice(menuitems){
        for (let i=0; i<menuitems.length; i++)
            total = i[0].getPrice();
        return total
    }

  }

