<?php

function insert($table, $fields = []) {
    $fieldString = '';
    $valueString = '';
    $values = [];

    foreach($fields as $field => $value) {
      $fieldString .= '`' . $field . '`,';
      $valueString .= '?,';
      $values[] = $value;
    }

    $fieldString = rtrim($fieldString, ',');
    $valueString = rtrim($valueString, ',');

    $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

}


function update($table, $id, $fields = []) {
    $fieldString = '';
    $values = [];

    foreach ($fields as $field => $value) {
        $fieldString .= ' ' . $field . ' = ?,';
        $values[] = $value;
    }

    $fieldString = trim($fieldString);
    $fieldString = rtrim($fieldString, ',');

    $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
}

function delete($table, $id) {
    $sql = "DELETE FROM {$table} WHERE id = {$id}";
}