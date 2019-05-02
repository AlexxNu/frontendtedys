<?php
session_destroy();
$url = Route::ctrRoute();
 
echo '<script>
window.location = "'.$url   .'"
</script>';