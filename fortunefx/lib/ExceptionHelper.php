<?php

function throwMasterFieldDataException($type)
{
  $exception_obj = getExceptionObject();
  return $exception_obj->throwMasterFieldDataException($type);
}

function getExceptionObject()
{
    $registry = Registry::getInstance();
    return $registry->getObject("exception");
}
