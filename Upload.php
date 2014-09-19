class Upload {

    public function __construct() {
        
    }

    public function addFile($post_name, $directory = '/usr/share/nginx/html/files/') {
        
        $FileErrorIndex = $_FILES[$post_name]["error"];

        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES[$post_name]["name"]);
        $extension = end($temp);
        
        $filename = "";

        if (!in_array($extension, $allowedExts)) {
            throw new \Exception('Invalid mime type', 504);
        }

        if ($FileErrorIndex == UPLOAD_ERR_OK) {
            $filename = date('Y') . '/' . date('m') . '/Image_' . sha1(date('YmdHis')) . '.' . $extension;
            if (!file_exists($directory . date('Y') . '/' . date('m'))) {
                mkdir($directory . date('Y') . '/' . date('m'), 0777, true);
            }
            $move = move_uploaded_file($_FILES[$post_name]["tmp_name"], $directory . $filename);
            if($move){
                return $filename;
            } else {
                throw new \Exception('Failed to move file', 502);
            }
        }
        else {
            switch ($FileErrorIndex) {
                case UPLOAD_ERR_INI_SIZE:
                    $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = "The uploaded file was only partially uploaded";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = "No file was uploaded";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = "Missing a temporary folder";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = "Failed to write file to disk";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $message = "File upload stopped by extension";
                    break;

                default:
                    $message = "Unknown upload error";
                    break;
            }
            throw new \Exception($message, 503);
        }
    }

}
