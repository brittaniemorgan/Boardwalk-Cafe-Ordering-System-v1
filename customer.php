<?php  
   class Customer {  
      var $cancel;  
      var $account;  
      var $orders;
      var $rewards;
      var $menu;
        
      function Customer__construct ($cancel, $account, $orders, $rewards, $menu) {  
         $this->cancel = $cancel;
         $this->account = $account;
         $this->orders = $orders;
         $this->rewards = $rewards;
         $this->menu = $menu;

      }  

      function get_cancel(){
        return $this->cancel;
      }

      function get_account(){
        return $this->account;
      }

      function get_orders(){
        return $this->orders;
      }

      function get_rewards(){
        return $this->rewards;
      }

      function get_menu(){
        return $this->menu;
      }


      function viewMenu (){

      }

      function placeOrder (){

    }

      function rewards (){

    }

      function cancelOrder (){

    }

      function createAcc (){

    }

      function viewOrders (){

    }
      
   }  
  
?>  