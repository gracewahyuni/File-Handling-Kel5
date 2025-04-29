<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    
    $tagAsal = trim($_POST['tag_asal']);
    $tagBaru = trim($_POST['tag_baru']);
    $tipeKeluaran = strtoupper($_POST['output_type']);

    if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['uploaded_file']['tmp_name'];
        $originalName = $_FILES['uploaded_file']['name'];
        $html = file_get_contents($tmpName);

        $html = str_replace("<$tagAsal>", "<$tagBaru>", $html);
        $html = str_replace("</$tagAsal>", "</$tagBaru>", $html);

        if ($tipeKeluaran === "O") {
            file_put_contents($originalName, $html);
            echo "<p style='color:green;'>Tag berhasil diubah dan disimpan dengan file yang sama dengan nama $originalName</p>";
        } 
        elseif ($tipeKeluaran === "N") {
            $newFile = preg_replace('/\.html$/i', '-new.html', $originalName);
            file_put_contents($newFile, $html);
            echo "<p style='color:green;'>Tag berhasil diubah dan disimpan dengan nama $newFile</p>";
        }   
    }
}
?>
