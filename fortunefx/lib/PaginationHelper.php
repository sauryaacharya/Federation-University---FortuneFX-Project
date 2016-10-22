<?php
function changePage($page_number)
{
    $pagination_obj = getPaginationObject();
    $pagination_obj->setCurPageNum($page_number);
    $pagination_obj->offset = ($page_number-1) * $pagination_obj->getItemPerPage();
}

function getPaginationObject()
{
    $registry = Registry::getInstance();
    return $registry->getObject("pagination");
}

function getCurPageNum()
{
    $pagination_obj = getPaginationObject();
    return $pagination_obj->getCurPageNum();
}

function getTotalItem()
{
    $pagination_obj = getPaginationObject();
    return $pagination_obj->getTotalItem();
}

function getItemPerPage()
{
    $pagination_obj = getPaginationObject();
    return $pagination_obj->getItemPerPage();
}