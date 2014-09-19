class Setting {

    //Variables
    public $ID;
    public $Key;
    public $Value;
    public $Description;
    public $Type;
    public $Options;

    const TYPE_TEXT = 1;
    const TYPE_TEXTFIELD = 2;
    const TYPE_DATE = 3;
    const TYPE_BOOLEAN = 4;
    const TYPE_SELECT = 5;

    public $types;

    const TABLE_NAME = 'Setting';

    public function __construct($database) {
        $this->database = $database;
        $types = [
            1 => "TYPE_TEXT",
            2 => "TYPE_TEXTFIELD",
            3 => "TYPE_DATE",
            4 => "TYPE_BOOLEAN",
            5 => "TYPE_SELECT"
        ];
    }

    public function update($key, $value) {
        $insert = $this->database->update("Setting", [
            "Value" => $value
                ], [
            "Key" => $key
        ]);
        return $insert == 1;
    }
    
    public function updateById($id, $value){
        $insert = $this->database->update("Setting", [
            "Value" => $value
                ], [
            "ID" => $id
        ]);
        return $insert == 1;
    }

    public function get($Key) {
        $data = $this->database->get("Setting", ["Value"], ["Key" => $Key]);
        if (is_array($data) && count($data) == 1)
            return $data["Value"];
        else
            return "";
    }

    public function all() {
        $data = $this->database->select(Setting::TABLE_NAME, "*");
        return $data;
    }

    public function add($key, $description, $options = null, $type = null) {
        if(!$this->exists($key)){
            $new_id = $this->database->insert("Setting", [
                "Key" => $key,
                "Value" => "",
                "Description" => $description,
                "Options" => $options,
                "Type" => $type
            ]);
            return $new_id;
        }
        return false;
    }

    public function delete($by, $value) {
        if ($by == 'key') {
            return $this->database->delete("Setting", ["Key" => $value]) == 1;
        } else if($by == 'id'){
            return $this->database->delete("Setting", ["ID" => $value]) == 1;
        }
        return false;
    }

    public function renderHtml($id ,$key, $type, $value, $options = null) {
        $return = "";
        switch ($type) {
            case 1:
                $return = '<input class="form-control input-'.$id.'" id="' . $key . '_text" type="text" value="' . $value . '" />';
                break;

            case 2:
                $return = '<textarea class="form-control input-'.$id.'" id="' . $key . '_textarea">' . $value . '</textarea>';
                break;

            case 3:
                $return = '<input id="' . $key . '_date" class="input-'.$id.' form-control form-control-inline input-medium date-picker" size="16" type="text" value="' . $value . '">';
                break;

            case 4:
                $return = '<input class="input-'.$id.'" id="' . $key . '_bool"'.(($value == 'on') ? 'checked' : '').' type="checkbox">';
                break;

            case 5:
                $choices = json_decode($options);
                $return = '<select id="' . $key . '_select" class="form-control input-'.$id.'">';
                foreach ($choices as $choice) {
                    $return .= '<option'.(($choice->Key == $value) ? ' selected' : '').' value="' . $choice->Key . '">' . $choice->Display . '</option>';
                }
                $return .= '</select>';
                break;
        }
        return $return;
    }
    
    public function exists($key){
        $data = $this->database->select("Setting", ["Value"], ["Key" => $key]);
        return count($data) > 0;
        
    
    }

}
