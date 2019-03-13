<?php
namespace System\Data;
interface IDatabase
{
    function Execute($query);
    function First($query);
    function FirstToClass($query,$class);
    function GetSingle($query);
    function ResultSet($query);
    function ResultSetToClass($query,$classname);
}