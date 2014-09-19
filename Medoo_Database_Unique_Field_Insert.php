function getUniqueToken(){
        $try = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        $unique = false;
        while (!$unique) {
            if ($this->database->has(TheClass::TABLE_NAME, [
                'Token' => $try
            ])
            ) {
                $unique = false;
                $try = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
            } else {
                $unique = true;
                break;
            }
        }
        return $try;
    }
