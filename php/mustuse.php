<?php
if(!isset($_COOKIE["logged"])) {
  echo '
  <script>
    document.getElementById("profile").style.display = "none";
    document.getElementById("reg").style.display = "";
    document.getElementById("log").style.display = "";
    document.getElementById("logout").style.display = "none";
  </script>
  ';
} else {
    echo '
    <script>
        document.getElementById("profile").style.display = "";
        document.getElementById("reg").style.display = "none";
        document.getElementById("log").style.display = "none";
        document.getElementById("logout").style.display = "";
    </script>
    ';
}

?>