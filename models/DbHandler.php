<?php
interface DbHandler{
    public function connect();
    public function disconnect();
    public function get_all_records_paginated($fields = array(), $start = 0);
    public function get_record_by_id($id);
    public function save($new_values);
    public function search($column, $column_value);
}