<?php
// function to sanitize input data
function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = html($data);
    return $data;
  }
  
  /**
   * Convert all applicable characters to HTML entities.
   *
   * @param string $data The string being converted.
   *
   * @return string The converted string.
   */
  function html($data)
  {
      return htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
  }