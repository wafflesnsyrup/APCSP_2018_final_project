<?php

?>
<div class="pop auto-height shadow-out bac-light mar-top mar-bot">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center list-no-margin">
    <?php
      if ($GLOBALS['currentPage'] == 1) {
        echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . ($GLOBALS['currentPage'] - 1) . "&album=" . $album . "\">Previous</a></li>";
      } else {
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . ($GLOBALS['currentPage'] - 1) . "&album=" . $album . "\">Previous</a></li>";
      }


      if ($GLOBALS['currentPage'] != 1) {
      echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=1&album=" . $album . "\">1</a></li>";
        echo "<li class=\"page-item disabled\"><a class=\"page-link black\" href=\"#\">...</a></li>";
      } else {

      }

      if ($GLOBALS['paginationPages'] >= $GLOBALS['totalPages']) {
        $pagesToDisplay = $totalPages;
      } else {
        $pagesToDisplay = $GLOBALS['paginationPages'];
      }

      for($i = 1; $i <= $pagesToDisplay; $i++) {
        if ($GLOBALS['currentPage'] == $i) {
          echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . $i . "&album=" . $album . "\">" . $i . "</a></li>";
        } else {
          echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . $i . "&album=" . $album . "\">" . $i . "</a></li>";
        }
      }

      if ($GLOBALS['currentPage'] != $GLOBALS['totalPages']) {
        echo "<li class=\"page-item disabled\"><a class=\"page-link black\" href=\"#\">...</a></li>";
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . $GLOBALS['totalPages'] . "&album=" . $album . "\">" . $GLOBALS['totalPages'] . "</a></li>";
      } else {

      }

      if ($GLOBALS['currentPage'] == $GLOBALS['totalPages']) {
        echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . ($GLOBALS['currentPage'] + 1) . "&album=" . $album . "\">Next</a></li>";
      } else {
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $GLOBALS['domain'] . "/albumview.php?page=" . ($GLOBALS['currentPage'] + 1) . "&album=" . $album . "\">Next</a></li>";
      }
      ?>
    </ul>
  </nav>
</div>
