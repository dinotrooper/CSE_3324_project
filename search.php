<?php
Class Search {
    private $keywords; //list of terms searched in search bar; can be blank?
    private $foundItemIDs; //list of items found by search algorithm and filter
    private $priceRangeNumOne; //first num for price range filter; minimum value
    private $priceRangeNumTwo; //second num for price range filter; maximum value
    private $categories; //a list of categories set by the user; 
    private $descending; //value that is set to 1 if the user wants to view the items in descending order; largest to smallest or z to a
    private $ascending; //value that is set to 1 if the user wants to view the items in ascending order; smallest to largest or a to z (default)
    private $alphabetical; //value set to 1 if the user wants to items to be sorted in alphabetical order
    private $numerical; //value set to 1 if the user wants the items to be sorted in numerical order (price)
    
    public function __construct($keywords) {
        //initalize class members
        $this->keywords = $keywords;
        $this->foundItemIDs = [];
        $this->priceRangeNumOne = -1;
        $this->priceRangeNumTwo = -1;
        $this->categories = [];
        $this->descending = 0;
        $this->ascending = 0;
        $this->numerical = 0;
        $this->alphabetical = 0;
        
        //apply a basic search filter with just the keywords
        $this->applyFilter();
    }
    
    public function getKeywords() {
        return ($this->keywords);
    }
    
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }
    
    public function getFoundItemIDs() {
        return ($this->foundItemIDs);
    }
    
    public function setFoundItemIDs($foundItemIDs) {
        $this->foundItemIDs = $foundItemIDs;
    }
    
    public function getPriceRangeNumOne() {
        return($this->priceRangeNumOne);
    } 
    
    public function setPriceRangeNumOne($priceRangeNumOne) {
        $this->priceRangeNumOne = $priceRangeNumOne;
    }
    
    public function getPriceRangeNumTwo() {
        return ($this->priceRangeNumTwo);
    }
    
    public function setPriceRangeTwo($priceRangeTwo) {
        $this->priceRangeNumTwo = $priceRangeTwo;
    }
    
    public function getCategories() {
        return ($this->categories);
    }
    
    public function setCategories($categories) {
        $this->categories = $categories;
    }
    
    public function getDescending() {
        return ($this->descending);
    }
    
    public function setDescending($descending) {
        $this->descending = $descending;
    }
    
    public function getAscending() {
        return($this->ascending);
    }
    
    public function setAscending($ascending) {
        $this->ascending = $ascending;
    }
    
    public function getAlphabetical() {
        return($this->alphabetical);
    }
    
    public function setAlphabetical($alphabetical) {
        $this->alphabetical = $alphabetical;
    }
    
    public function getNumerical() {
        return($this->numerical);
    }
    
    public function setNumerical($numerical) {
        $this->numerical = $numerical;
    }
    
    public function applyFilter() {
        //initialize function member
        $matchedItemIDs = [];
        
        //connect to database
        require_once 'login.php';
        $conn = new mysqli($hn, $db, $un, $pw);
        if ($conn->connect_error) die($conn->connect_error);
        
        //collect all of the items in the items table
        $query = "SELECT * FROM items";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        $rows = $result->num_rows;
        
        //loop through each keyword and item in tables to collect a list of items with matched keywords
        foreach ($this->keywords as $keyword) {
            for ($j = 0; $j < $rows; ++$j) {
                $result->data_seek($j);
                $tempItemName = $result->fetch_array(MYSQLI_ASSOC)['itemName'];
                if (strpos($tempItemName, $keyword) !== false) {
                    $matchedItemIDs[] = $result->fetch_array(MYSQLI_ASSOC)['itemID'];
                }
            }
        }
        
        //clear list of any duplicates
        for ($j = 0; $j < count($matchedItemIDs); ++$j) {
            for ($i = $j + 1; $i < count($matchedItemIDs); ++$i) {
                if ($matchedItemIDs[$i] != NULL and $matchedItemIDs[$j != NULL] ) {
                    if ($matchedItemIDs[$i] == $matchedItemIDs[$j]) {
                        $matchedItemIDs[$i] = NULL;
                    }
                }
            }
        }
        
        //cross reference categories list and category of each keyword-matched item
        if (count($this->categories) > 0) {
            for($j = 0; $j < count($matchedItemIDs); ++$j) {
                $query = "SELECT itemCategory FROM items WHERE itemID = $matchedItemIDs[$j]";
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                
                $result->data_seek(0);
                $itemCategory = $result->fetch_array(MYSQLI_ASSOC)['itemCategory'];
                
                if (($key = array_search($itemCategory, $this->categories)) === false) {
                    $matchedItemIDs[$j] = NULL;
                }
            }
        }
        
        //cross reference the price of each remaining keyword-matched item and the minimum price
        if ($this->priceRangeNumOne > -1 and $this->priceRangeNumTwo > -1) {
            for($j = 0; $j < count($matchedItemIDs); ++$j) {
                $query = "SELECT itemPrice FROM items WHERE itemID = $matchedItemIDs[$j]";
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                
                $result->data_seek(0);
                $itemPrice = $result->fetch_array(MYSQLI_ASSOC)['itemPrice'];
                
                if ($itemPrice < $this->priceRangeNumOne or $itemPrice > $this->priceRangeNumTwo) {
                    $matchedItemIDs[$j] = NULL;
                }
            }
        }
        
        //now to sort the array using either numerical or alphabetical sorting
        //from either high to low (z to a) or low to high (a to z)
        $sortingArray = [];
        if ($this->numerical == 1) {
            //create an associate array 
            //the key being the itemPrice and the value being the itemID
            for($j = 0; $j < count($matchedItemIDs); ++$j) {
                $query = "SELECT itemPrice FROM items WHERE itemID = $matchedItemIDs[$j]";
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                
                $result->data_seek(0);
                $sortingArray[$result->fetch_array(MYSQLI_ASSOC)['itemPrice']] = $matchedItemIDs[$j];
            }
            
            if ($this->descending == 1) {
                //sort the keys of the array from high to low
                krsort($sortingArray, 'SORT_NUMERIC');
            }
            else {
                //sort the keys of the array from low to high
                ksort($sortingArray, 'SORT_NUMERIC');
            }
        }
        
        elseif ($this->alphabetical == 1) {
            //create an associate array
            //the key being the itemName and the value being the itemID
            for($j = 0; $j < count($matchedItemIDs); ++$j) {
                $query = "SELECT itemName FROM items WHERE itemID = $matchedItemIDs[$j]";
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                
                $result->data_seek(0);
                $sortingArray[$result->fetch_array(MYSQLI_ASSOC)['itemName']] = $matchedItemIDs[$j];
            }
            if ($this->descending == 1) {
                //sort the keys of the array from z to a
                krsort($sortingArray, 'SORT_STRING');
            }
            else {
                //sort the keys of the array from a to z
                ksort($sortingArray, 'SORT_STRING');
            }
        }
        
        //if the remaining keyword-matched items were sorted
        //transfer the value of the associate arrays into the class member $foundItemIDs
        if(count($sortingArray) > 0) {
            foreach($sortingArray as $itemID) {
                $this->foundItemIDs[] = $itemID;
            }
        } 
        else {
            //otherwise set the foundItemIDs array equal to $matchedItemIDs
           $this->foundItemIDs = $matchedItemIDs;
        }
        
        //disconnect from database
        $conn->close();
    }
}
?>