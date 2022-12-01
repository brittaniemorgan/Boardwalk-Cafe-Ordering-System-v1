export class MenuIitem {

    constructor(name, price, size) {  // Constructor
        this.itemName = name;
        this.size = size;
        this.price = price;
 
    }

    getItemName(){
        return this.itemName;
    }

    getSize(){
        return this.size;
    }

    getPrice(){
        return this.price;
    }



}