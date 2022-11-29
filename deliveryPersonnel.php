<?php  
   class DeliveryPersonnel {  
      var $status;  
      var $view;  
        
      function DeliveryPersonnel__construct ($status, $view) {  
         $this->status = $status;
         $this->view - $view;
      }  
      
      function get_status(){
        return $this->status;
      }

      function get_view(){
        return $this->view;
      }


      function updateStatus (){

    }


      function viewOrdersMinor (){

    }
   }  
  
?>