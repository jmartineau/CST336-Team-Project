<?php
    require_once('connection.php');
    session_start();
    
    // Compatibility checks:
    $errors = [];
    $i = 0;
    
    // Check to make sure atleast one of each part is selected
    if (!allComponentsSelected()) {
        $errors[$i] = "One or more components not selected";
        $i++;
        header("Location: index.php");
    } else {
        
        // CPU.socket  == Motherboard.socketType
        if (socketMismatch()) {
            $errors[$i] = "Motherboard and CPU have different socket types";
            $i++;
        }
        
        // RAM.type == Motherboard.ramType
        if (ramTypeMismatch()) {
            $errors[$i] = "Memory type selected is not compatable with the motherboard";
            $i++;
        }
        
        // Total ram size <= motherboard max ram 
        if (ramSizeTooLarge()) {
            $errors[$i] = "Memory size exceeds motherboards allowed memory size";
            $i++;
        }
        
        // Motherboard form factor <= case’s allowed mb form factor
        if (motherboardFormFactorIncompatable()) {
            $errors[$i] = "Motherboard is too large for the case selected";
            $i++;
        }
        
        // GPU length <= case's max gpu length
        if (gpuTooLong()) {
            $errors[$i] = "GPU length exceeds case's normal allowed GPU length";
            $i++;
        }
        
        // Total TDP <= PSU.watts (warning if within 50 watts)
        $excessWatts = excessPSUPower();
        if($excessWatts < 100 && $excessWatts > 0) {
            $errors[$i] = "Power consumption nears power supply's max, computer may be unstable";
            $i++;
        }elseif ($excessWatts <= 0) {
            $errors[$i] = "Power supply does not supply enough power for the computer";
            $i++;
        }
    }
    
    $_SESSION["errors"] = $errors;
    header("Location: index.php");
    

    
    // FUNCTIONS
    function allComponentsSelected(){
      if ($_SESSION["cpuSelected"] == NULL){
          return false;
      }
      if ($_SESSION["mbSelected"] == NULL){
          return false;
      }
      if ($_SESSION["ramSelected"] == NULL){
          return false;
      }
      if ($_SESSION["storageSelected"] == NULL){
          return false;
      }
      if ($_SESSION["gpuSelected"] == NULL){
          return false;
      }
      if ($_SESSION["caseSelected"] == NULL){
          return false;
      }
      if ($_SESSION["psuSelected"] == NULL){
          return false;
      }
      return true;
  }
  
    function socketMismatch() {
        if (strcmp($_SESSION["cpuSelected"]["cpuSocketId"] , $_SESSION["mbSelected"]["mbSocketId"]) == 0) {
            return false;
        } 
        return true;
    }
  
    function ramTypeMismatch() {
        if (strcmp($_SESSION["mbSelected"]["mbRamTypeId"] , $_SESSION["ramSelected"]["ramTypeId"]) == 0) {
          return false;
        }
        return true;
    }
    
    function ramSizeTooLarge() {
        if ($_SESSION["mbSelected"]["maxRamGB"] <  $_SESSION["ramSelected"]["ramSizeGB"]) {
            return true;
        }
        return false;
    }
    
    function motherboardFormFactorIncompatable() {
        //caseFFId=MBFormFactors.mbFFId
        if ($_SESSION["mbSelected"]["mbFFId"]  <= $_SESSION["caseSelected"]["caseFFId"]) {
            return false;
        } 
        return true;
    }
    
    function gpuTooLong() {
        if ($_SESSION["caseSelected"]["maxGPULengthInches"]  >= $_SESSION["gpuSelected"]["gpuLengthInches"]) {
            return false;
        } 
        return true;
    }
    
    function excessPSUPower() {
        $available = $_SESSION["psuSelected"]["psuWatts"];
        $consumed = $_SESSION["cpuSelected"]["cpuTDP"] + $_SESSION["gpuSelected"]["gpuTDP"];
        return $available - $consumed;
    }
?>