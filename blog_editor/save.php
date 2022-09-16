<?php 
    $json = $_POST['json'];
    $html = $_POST['html'];
    $title = $_POST['title'];
    $id = $_POST['id'];

    $file = "<?php\n";
    $file .= '$title = \''.$title.'\';'."\n";
    $file .= '$json = \''.$json.'\';'."\n";
    $file .= '$html = \''.$html.'\';'."\n";
    $file .= '?>';

    $filepath = "../blog/blog_entry_".$id.".php";
    
    file_put_contents($filepath, $file);
?>