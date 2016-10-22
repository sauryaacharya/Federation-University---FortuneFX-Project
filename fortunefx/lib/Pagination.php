<?php

class Pagination {

    private $num_of_item_per_page;
    private $range;
    private $current_page_number = 1;
    private $total_item;
    private $total_page;
    public $offset = 0;
    private $cur_page_index;
    public $start;
    public $end;

    public function __construct() {
	
    }

    public function setPagination($num_of_item_per_page, $range, $total_item) {
        $this->num_of_item_per_page = $num_of_item_per_page;
        $this->range = $range;
        $this->setTotalItem($total_item);
    }

    public function getRange() {
        return $this->range;
    }

    public function getItemPerPage() {
        return $this->num_of_item_per_page;
    }

    public function setCurPageNum($current_page_number) {
        $this->current_page_number = $current_page_number;
    }

    public function getCurPageNum() {
        return $this->current_page_number;
    }

    public function setTotalItem($total_item) {
        $this->total_item = $total_item;
    }

    public function getTotalItem() {
        return $this->total_item;
    }

    public function getCurPageIndex() {
        $this->cur_page_index = $this->current_page_number - 1;
        return $this->cur_page_index;
    }

    public function getTotalPage() {
        $test = $this->total_item / $this->num_of_item_per_page;
        $item_count_array = explode(".", $test);
        //print_r($item_count_array);
        if (count($item_count_array) == 1) {
            $this->total_page = $item_count_array[0];
            return $item_count_array[0];
        } else {
            $this->total_page = $item_count_array[0] + 1;
            return $item_count_array[0] + 1;
        }
    }

    public function getPageNumbers() {

        $this->getTotalPage();
        $page_num = str_split($this->getPageNumbersBlock($this->total_page));

        $page_number = array_reverse($page_num);
        $this->start = 0;
        $this->end = $this->range;
        if ($this->total_page > $this->range) {

            if ($this->current_page_number >= $this->range) {
                $this->end = $this->current_page_number + 1;
                $this->start = $this->current_page_number - $this->range + 1;
            }
            if ($this->current_page_number == $this->total_page) {
                $this->end = $this->current_page_number;
                $this->start = $this->current_page_number - $this->range;
            }
        } else {
            $this->start = 0;
            $this->end = $this->total_page;
        }
        
        return $page_number;
    }

    public function getPageNumbersBlock($total_page) {
        if ($total_page != 0) {
            return $total_page . $this->getPageNumbersBlock($total_page - 1);
        }
    }

    public function changePage($page_number) {
        $this->setCurPageNum($page_number);
        $this->offset = ($page_number - 1) * $this->getItemPerPage();
    }

}
