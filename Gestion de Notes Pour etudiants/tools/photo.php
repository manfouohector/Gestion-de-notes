<?php 
    class Photo{
        public function upload_image($image) {
            $fold = "../image/";
            move_uploaded_file($image['tmp_name'], $fold . $image['name']);
            return $image['name'];
        }
    }
?>
 