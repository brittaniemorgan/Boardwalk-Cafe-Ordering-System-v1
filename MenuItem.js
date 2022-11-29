export class MenuIitem {

    constructor(name, category, price) {  // Constructor
        this.itemName = name;
        this.category = category;
        this.price = price;
 
    }

    getItemName(){
        return this.itemName;
    }

    getCategory(){
        return this.category;
    }

    getPrice(){
        return this.price;
    }



}